<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Product;

#[Layout('components.layouts.admin')]
#[Title('Produk - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $category_id = '';
    public $status = '';

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        session()->flash('success', 'Produk berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.products.index', [
            'items' => Product::with('category')
                ->when($this->search, fn($q) => $q->where('name', 'like', '%'.$this->search.'%'))
                ->when($this->category_id, fn($q) => $q->where('category_id', $this->category_id))
                ->when($this->status, fn($q) => $q->where('status', $this->status))
                ->orderBy('created_at', 'desc')->paginate(10),
            'categories' => \App\Models\ProductCategory::where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
