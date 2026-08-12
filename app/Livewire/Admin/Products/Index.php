<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Produk - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public string $status = '';

    /**
     * Reset pagination ketika pencarian berubah.
     */
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Reset pagination ketika filter status berubah.
     */
    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    /**
     * Hapus produk.
     */
    public function delete(int $id): void
    {
        $product = Product::findOrFail($id);

        $product->delete();

        session()->flash(
            'success',
            'Produk berhasil dihapus.'
        );
    }

    /**
     * Render halaman admin products.
     */
    public function render()
    {
        $items = Product::query()
            ->when(
                $this->search !== '',
                fn ($query) => $query->where(
                    'name',
                    'like',
                    '%' . $this->search . '%'
                )
            )
            ->when(
                $this->status !== '',
                fn ($query) => $query->where(
                    'is_active',
                    $this->status === 'active'
                )
            )
            ->orderByDesc('created_at')
            ->paginate(10);

        return view(
            'livewire.admin.products.index',
            compact('items')
        );
    }
}