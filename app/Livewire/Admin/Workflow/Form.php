<?php

namespace App\Livewire\Admin\Workflow;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\WorkflowStep;

#[Layout('components.layouts.admin')]
#[Title('Form Alur Kerja - Admin OMH Vector')]
class Form extends Component
{
    public $itemId = null;
    public $title = '';
    public $description = '';
    public $step_number = 1;
    public $step_order = 0;
    public $is_active = true;
    public $isEditing = false;

    public function mount($workflow = null)
    {
        if ($workflow) {
            $this->isEditing = true;
            $item = WorkflowStep::findOrFail($workflow);
            $this->itemId = $item->id;
            $this->title = $item->title;
            $this->description = $item->description;
            $this->step_number = $item->step_number;
            $this->step_order = $item->step_order;
            $this->is_active = $item->is_active;
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'step_number' => 'required|integer|min:1',
            'step_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $item = $this->isEditing ? WorkflowStep::findOrFail($this->itemId) : new WorkflowStep();
        $item->title = $this->title;
        $item->description = $this->description;
        $item->step_number = $this->step_number;
        $item->step_order = $this->step_order;
        $item->is_active = $this->is_active;
        $item->save();

        session()->flash('success', $this->isEditing ? 'Langkah alur kerja berhasil diperbarui.' : 'Langkah alur kerja berhasil ditambahkan.');
        return $this->redirect(route('admin.workflow.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.workflow.form');
    }
}
