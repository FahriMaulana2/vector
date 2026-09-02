<?php

namespace App\Livewire\Admin\Workflow;

use App\Models\WorkflowStep;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Alur Kerja - Admin OMAH Vector')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function delete($id)
    {
        $item = WorkflowStep::findOrFail($id);
        $item->delete();
        session()->flash('success', 'Langkah alur kerja berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.workflow.index', [
            'items' => WorkflowStep::when($this->search, fn ($q) => $q->where('title', 'like', '%'.$this->search.'%'))
                ->orderBy('sort_order') // ✅ PERBAIKAN: 'step_order' diganti menjadi 'sort_order'
                ->orderBy('step_number') // Tambahan: urutkan juga berdasarkan nomor langkah
                ->paginate(10),
        ]);
    }
}
