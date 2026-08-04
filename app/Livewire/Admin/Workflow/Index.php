<?php

namespace App\Livewire\Admin\Workflow;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\WorkflowStep;

#[Layout('components.layouts.admin')]
#[Title('Alur Kerja - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public function delete($id)
    {
        $item = WorkflowStep::findOrFail($id);
        $item->delete();
        session()->flash('success', 'Langkah alur kerja berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.workflow.index', [
            'items' => WorkflowStep::orderBy('step_order')->paginate(10),
        ]);
    }
}
