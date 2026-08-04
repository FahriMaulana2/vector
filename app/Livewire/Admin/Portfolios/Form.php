<?php

namespace App\Livewire\Admin\Portfolios;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;

#[Layout('components.layouts.admin')]
#[Title('Form Portofolio - Admin OMH Vector')]
class Form extends Component
{
    use WithFileUploads;

    public $itemId = null;
    public $category_id = '';
    public $title = '';
    public $client_name = '';
    public $project_year = '';
    public $description = '';
    public $image;
    public $existing_image = null;
    public $gallery = [];
    public $existing_gallery = [];
    public $is_active = true;
    public $isEditing = false;

    public function mount($portfolio = null)
    {
        if ($portfolio) {
            $this->isEditing = true;
            $item = Portfolio::with('images')->findOrFail($portfolio);
            $this->itemId = $item->id;
            $this->category_id = $item->category_id;
            $this->title = $item->title;
            $this->client_name = $item->client_name;
            $this->project_year = $item->project_year;
            $this->description = $item->description;
            $this->existing_image = $item->image;
            $this->existing_gallery = $item->images->pluck('image')->toArray();
            $this->is_active = $item->is_active;
        }
    }

    public function save()
    {
        $this->validate([
            'category_id' => 'required|exists:portfolio_categories,id',
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'project_year' => 'nullable|string|max:4',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $item = $this->isEditing ? Portfolio::findOrFail($this->itemId) : new Portfolio();
        $item->category_id = $this->category_id;
        $item->title = $this->title;
        $item->client_name = $this->client_name;
        $item->project_year = $this->project_year;
        $item->description = $this->description;
        $item->is_active = $this->is_active;

        if ($this->image) {
            $item->image = $this->image->store('portfolios', 'public');
        }

        $item->save();

        if ($this->gallery) {
            foreach ($this->gallery as $img) {
                $item->images()->create(['image' => $img->store('portfolios/gallery', 'public')]);
            }
        }

        session()->flash('success', $this->isEditing ? 'Portofolio berhasil diperbarui.' : 'Portofolio berhasil ditambahkan.');
        return $this->redirect(route('admin.portfolios.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.portfolios.form', [
            'categories' => PortfolioCategory::where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
