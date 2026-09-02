<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Portfolios;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Form Portofolio - Admin OMAH Vector')]
class Form extends Component
{
    use WithFileUploads;

    public ?int $itemId = null;

    public string $title = '';

    public string $client = '';

    public ?int $portfolio_category_id = null;

    public string $project_date = '';

    public string $description = '';

    public $image = null;

    public ?string $existing_image = null;

    public array $gallery = [];

    public array $existing_gallery = [];

    public bool $is_featured = false;

    public int $sort_order = 0;

    public bool $is_active = true;

    public bool $isEditing = false;

    /**
     * Load portfolio when editing.
     */
    public function mount($portfolio = null): void
    {
        if (! $portfolio) {
            return;
        }

        $this->isEditing = true;

        $item = Portfolio::with('images')->findOrFail($portfolio);

        $this->itemId = $item->id;
        $this->title = $item->title ?? '';
        $this->client = $item->client ?? '';
        $this->portfolio_category_id = $item->portfolio_category_id;
        $this->project_date = $item->project_date
            ? $item->project_date->format('Y-m-d')
            : '';

        $this->description = $item->description ?? '';

        $this->existing_image = $item->image;

        $this->existing_gallery = $item->images
            ->pluck('image')
            ->filter()
            ->values()
            ->toArray();

        $this->is_featured = (bool) $item->is_featured;
        $this->sort_order = (int) $item->sort_order;
        $this->is_active = (bool) $item->is_active;
    }

    /**
     * Validation rules.
     */
    protected function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'client' => [
                'nullable',
                'string',
                'max:255',
            ],

            'portfolio_category_id' => [
                'nullable',
                'integer',
                'exists:portfolio_categories,id',
            ],

            'project_date' => [
                'nullable',
                'date',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'max:5120',
            ],

            'gallery' => [
                'nullable',
                'array',
            ],

            'gallery.*' => [
                'image',
                'max:5120',
            ],

            'is_featured' => [
                'boolean',
            ],

            'sort_order' => [
                'required',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'boolean',
            ],
        ];
    }

    /**
     * Save portfolio.
     */
    public function save(): void
    {
        $this->validate();

        if ($this->isEditing) {
            $item = Portfolio::findOrFail($this->itemId);
        } else {
            $item = new Portfolio;
        }

        $item->title = $this->title;
        $item->description = $this->description ?: null;
        $item->client = $this->client ?: null;
        $item->portfolio_category_id = $this->portfolio_category_id;
        $item->project_date = $this->project_date ?: null;
        $item->is_featured = $this->is_featured;
        $item->sort_order = $this->sort_order;
        $item->is_active = $this->is_active;

        /*
        |--------------------------------------------------------------------------
        | Main Image
        |--------------------------------------------------------------------------
        */

        if ($this->image) {

            // Hapus gambar lama ketika edit
            if (
                $item->image &&
                Storage::disk('public')->exists($item->image)
            ) {
                Storage::disk('public')->delete($item->image);
            }

            $item->image = $this->image->store(
                'portfolios',
                'public'
            );
        }

        $item->save();

        /*
        |--------------------------------------------------------------------------
        | Gallery Images
        |--------------------------------------------------------------------------
        */

        foreach ($this->gallery as $galleryImage) {

            $item->images()->create([
                'image' => $galleryImage->store(
                    'portfolios/gallery',
                    'public'
                ),
            ]);
        }

        session()->flash(
            'success',
            $this->isEditing
                ? 'Portofolio berhasil diperbarui.'
                : 'Portofolio berhasil ditambahkan.'
        );

        $this->redirect(
            route('admin.portfolios.index'),
            navigate: true
        );
    }

    /**
     * Remove existing gallery image.
     */
    public function removeGalleryImage(string $image): void
    {
        if (! $this->itemId) {
            return;
        }

        $item = Portfolio::findOrFail($this->itemId);

        $galleryImage = $item->images()
            ->where('image', $image)
            ->first();

        if (! $galleryImage) {
            return;
        }

        if (
            $galleryImage->image &&
            Storage::disk('public')->exists($galleryImage->image)
        ) {
            Storage::disk('public')->delete(
                $galleryImage->image
            );
        }

        $galleryImage->delete();

        $this->existing_gallery = array_values(
            array_filter(
                $this->existing_gallery,
                fn ($item) => $item !== $image
            )
        );
    }

    /**
     * Remove main image.
     */
    public function removeMainImage(): void
    {
        if (! $this->itemId) {
            return;
        }

        $item = Portfolio::findOrFail($this->itemId);

        if (
            $item->image &&
            Storage::disk('public')->exists($item->image)
        ) {
            Storage::disk('public')->delete($item->image);
        }

        $item->image = null;
        $item->save();

        $this->existing_image = null;
    }

    /**
     * Cancel form.
     */
    public function cancel(): void
    {
        $this->redirect(
            route('admin.portfolios.index'),
            navigate: true
        );
    }

    /**
     * Render.
     */
    public function render()
    {
        return view(
            'livewire.admin.portfolios.form',
            ['categories' => PortfolioCategory::active()->ordered()->get()]
        );
    }
}
