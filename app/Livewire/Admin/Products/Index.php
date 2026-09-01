<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Produk - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';
    
    // Properti untuk sorting
    public string $sortBy = 'id';
    public string $sortDirection = 'desc'; // Default: ID terbesar (terbaru) di atas

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
     * Ubah urutan sorting saat header tabel diklik.
     */
    public function setSortBy(string $field): void
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    /**
     * Hapus produk beserta gambarnya.
     */
    public function delete(int $id): void
    {
        $product = Product::findOrFail($id);

        // Hapus gambar utama jika ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Hapus semua gambar gallery
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->image);
        }

        $product->delete();

        session()->flash('success', 'Produk berhasil dihapus.');
    }

    /**
     * Render halaman admin products.
     */
    public function render()
    {
        $items = Product::query()
            ->with(['category', 'images']) // Eager load untuk mencegah N+1 query & menampilkan kategori
            ->when(
                $this->search !== '',
                fn ($query) => $query->where('name', 'like', '%'.$this->search.'%')
            )
            ->when(
                $this->status !== '',
                fn ($query) => $query->where('is_active', $this->status === 'active')
            )
            ->orderBy($this->sortBy, $this->sortDirection) // Sorting dinamis
            ->paginate(10);

        return view('livewire.admin.products.index', compact('items'));
    }
}