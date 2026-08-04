<?php

namespace App\Livewire\Admin\ProductCategories;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\ProductCategory;

#[Layout('components.layouts.admin')]
#[Title('Form Kategori Produk - Admin OMH Vector')]
class Form extends Component
{
    public $itemId = null;
    public $name = '';
    public $slug = '';
    public $description = '';
    public $is_active = true;
    public $isEditing = false;

    public function mount($productCategory = null)
    {
        if ($productCategory) {
            $this->isEditing = true;
            $item = ProductCategory::findOrFail($productCategory);
            $this->itemId = $item->id;
            $this->name = $item->name;
            $this->slug = $item->slug;
            $this->description = $item->description;
            $this->is_active = $item->is_active;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:product_categories,slug,' . $this->itemId,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $item = $this->isEditing ? ProductCategory::findOrFail($this->itemId) : new ProductCategory();
        $item->name = $this->name;
        $item->slug = $this->slug ?: \Illuminate\Support\Str::slug($this->name);
        $item->description = $this->description;
        $item->is_active = $this->is_active;
        $item->save();

        session()->flash('success', $this->isEditing ? 'Kategori berhasil diperbarui.' : 'Kategori berhasil ditambahkan.');
        return $this->redirect(route('admin.product-categories.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.product-categories.form');
    }
}
