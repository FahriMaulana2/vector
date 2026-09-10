<?php

declare(strict_types=1);

namespace App\Livewire\Admin\About;

use App\Models\AboutMilestone;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Milestone/Timeline - Admin OMAH Vector')]
class MilestoneIndex extends Component
{
    use WithPagination;

    public function delete(int $id): void
    {
        $item = AboutMilestone::findOrFail($id);
        $item->delete();
        session()->flash('success', 'Milestone berhasil dihapus.');
    }

    public function render(): View
    {
        return view('livewire.admin.about.milestone-index', [
            'items' => AboutMilestone::orderBy('year')->orderBy('sort_order')->paginate(10),
        ]);
    }
}
