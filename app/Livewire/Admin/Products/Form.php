<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Product;
use App\Models\ProductCategory;

#[Layout('components.layouts.admin')]
#[Title('Form Produk - Admin OMH Vector')]
class Form extends Component
{
    use WithFileUploads;

    public $itemId = null;
    public $category_id = '';
    public $name = '';
    public $description = '';
    public $price = 0;
    public $image;
    public $existing_image = null;
    public $badge = '';
    public $status = 'active';
    public $gallery = [];
    public $existing_gallery = [];
    public $isEditing = false;

    public function mount($product = null)
    {
        if ($product) {
            $this->isEditing = true;
            $item = Product::with('images')->findOrFail($product);
            $this->itemId = $item->id;
            $this->category_id = $item->category_id;
            $this->name = $item->name;
            $this->description = $item->description;
            $this->price = $item->price;
            $this->existing_image = $item->image;
            $this->badge = $item->badge;
            $this->status = $item->status;
            $this->existing_gallery = $item->images->pluck('image')->toArray();
        }
    }

    public function save()
    {
        $this->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'badge' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        $item = $this->isEditing ? Product::findOrFail($this->itemId) : new Product();
        $item->category_id = $this->category_id;
        $item->name = $this->name;
        $item->description = $this->description;
        $item->price = $this->price;
        $item->badge = $this->badge;
        $item->status = $this->status;

        if ($this->image) {
            $item->image = $this->image->store('products', 'public');
        }

        $item->save();

        if ($this->gallery) {
            foreach ($this->gallery as $img) {
                $item->images()->create(['image' => $img->store('products/gallery', 'public')]);
            }
        }

        session()->flash('success', $this->isEditing ? 'Produk berhasil diperbarui.' : 'Produk berhasil ditambahkan.');
        return $this->redirect(route('admin.products.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.products.form', [
            'categories' => ProductCategory::where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
