<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Portfolios;

use App\Models\Portfolio;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Portofolio - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public string $search = '';

    /**
     * Reset pagination ketika pencarian berubah.
     */
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Delete portfolio.
     */
    public function delete(int $id): void
    {
        $portfolio = Portfolio::findOrFail($id);

        $portfolio->delete();

        session()->flash(
            'success',
            'Portofolio berhasil dihapus.'
        );
    }

    public function render()
    {
        $items = Portfolio::query()
            ->with('images')
            ->when(
                trim($this->search) !== '',
                function ($query) {
                    $query->where(function ($q) {
                        $q->where(
                            'title',
                            'like',
                            '%' . trim($this->search) . '%'
                        )
                        ->orWhere(
                            'client',
                            'like',
                            '%' . trim($this->search) . '%'
                        )
                        ->orWhere(
                            'description',
                            'like',
                            '%' . trim($this->search) . '%'
                        );
                    });
                }
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view(
            'livewire.admin.portfolios.index',
            compact('items')
        );
    }
}