<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Portfolios;

use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Portofolio - Admin OMAH Vector')]
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
     * Hapus portofolio beserta file gambar terkait dari storage.
     */
    public function destroy(int $id): void
    {
        $portfolio = Portfolio::with('images')->findOrFail($id);

        // Hapus file gambar utama dari storage jika ada
        if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
            Storage::disk('public')->delete($portfolio->image);
        }

        // Hapus file gambar gallery dari storage jika ada
        foreach ($portfolio->images as $img) {
            if ($img->image && Storage::disk('public')->exists($img->image)) {
                Storage::disk('public')->delete($img->image);
            }
        }

        $portfolio->delete();

        session()->flash('success', 'Portofolio berhasil dihapus.');
        $this->dispatch('notify', type: 'success', message: 'Portofolio berhasil dihapus.');
    }

    /**
     * Delete portfolio (alias method).
     */
    public function delete(int $id): void
    {
        $this->destroy($id);
    }

    /**
     * Route handler for HTTP DELETE /admin/portfolios/{portfolio}.
     */
    public function destroyRoute(Portfolio $portfolio)
    {
        $this->destroy($portfolio->id);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Portofolio berhasil dihapus.',
            ]);
        }

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portofolio berhasil dihapus.');
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
                            '%'.trim($this->search).'%'
                        )
                            ->orWhere(
                                'client',
                                'like',
                                '%'.trim($this->search).'%'
                            )
                            ->orWhere(
                                'description',
                                'like',
                                '%'.trim($this->search).'%'
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
