<?php

namespace App\Livewire\Admin\ProductCategories;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\ProductCategory;

#[Layout('components.layouts.admin')]
#[Title('Kategori Produk - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function delete($id)
    {
        ProductCategory::findOrFail($id)->delete();
        session()->flash('success', 'Kategori produk berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.product-categories.index', [
            'items' => ProductCategory::when($this->search, fn($q) => $q->where('name', 'like', '%'.$this->search.'%'))
                ->orderBy('name')->paginate(10),
        ]);
    }
}
