<?php

declare(strict_types=1);

namespace App\Livewire\Admin\About;

use App\Models\AboutStat;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Statistik Tentang - Admin OMAH Vector')]
class StatIndex extends Component
{
    use WithPagination;

    public function delete(int $id): void
    {
        $item = AboutStat::findOrFail($id);
        $item->delete();
        session()->flash('success', 'Statistik berhasil dihapus.');
    }

    public function render(): View
    {
        return view('livewire.admin.about.stat-index', [
            'items' => AboutStat::orderBy('sort_order')->orderBy('id')->paginate(10),
        ]);
    }
}
