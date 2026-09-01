<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Form Produk - Admin OMH Vector')]
class Form extends Component
{
    use WithFileUploads;

    public $itemId = null;

    public $name = '';

    public $description = '';

    public $image;

    public $existing_image = null;

    public $badge = '';

    public bool $is_active = true;

    public $gallery = [];

    public $existing_gallery = [];

    public bool $isEditing = false;

    // Properti untuk kategori
    public $product_category_id = null;

    /**
     * Load product ketika mode edit.
     */
    public function mount($product = null): void
    {
        if (! $product) {
            return;
        }

        $this->isEditing = true;

        $item = Product::with('images')->findOrFail($product);

        $this->itemId = $item->id;
        $this->name = $item->name;
        $this->description = $item->description;
        $this->existing_image = $item->image;
        $this->badge = $item->badge ?? '';
        $this->is_active = (bool) $item->is_active;
        $this->product_category_id = $item->product_category_id;

        $this->existing_gallery = $item->images
            ->pluck('image')
            ->toArray();
    }

    /**
     * Simpan produk.
     */
    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'badge' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'gallery.*' => 'nullable|image|max:2048',
            'product_category_id' => 'required|exists:product_categories,id',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create / Update Product
        |--------------------------------------------------------------------------
        */

        $item = $this->isEditing
            ? Product::findOrFail($this->itemId)
            : new Product;

        $item->name = $this->name;

        // ✅ FIX: Generate slug otomatis dari nama produk agar tidak error "slug doesn't have a default value"
        $item->slug = Str::slug($this->name);

        $item->description = $this->description;
        $item->badge = $this->badge ?: null;
        $item->is_active = $this->is_active;
        $item->product_category_id = $this->product_category_id;

        /*
        |--------------------------------------------------------------------------
        | Main Image
        |--------------------------------------------------------------------------
        */

        if ($this->image) {
            $item->image = $this->image->store('products', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Save Product
        |--------------------------------------------------------------------------
        */

        $item->save();

        /*
        |--------------------------------------------------------------------------
        | Gallery Images
        |--------------------------------------------------------------------------
        */

        if (! empty($this->gallery)) {
            foreach ($this->gallery as $img) {
                $item->images()->create([
                    'image' => $img->store('products/gallery', 'public'),
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Success Message
        |--------------------------------------------------------------------------
        */

        session()->flash(
            'success',
            $this->isEditing
                ? 'Produk berhasil diperbarui.'
                : 'Produk berhasil ditambahkan.'
        );

        return $this->redirect(
            route('admin.products.index'),
            navigate: true
        );
    }

    /**
     * Render form.
     */
    public function render()
    {
        return view('livewire.admin.products.form', [
            'categories' => ProductCategory::orderBy('sort_order')
                ->orderBy('name')
                ->get(),
        ]);
    }
}
