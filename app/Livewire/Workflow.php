<?php

namespace App\Livewire;

use App\Models\WorkflowStep;
use Livewire\Component;

class Workflow extends Component
{
    public function render()
    {
        $steps = WorkflowStep::active()
            ->ordered()
            ->get();

        return view('livewire.workflow', compact('steps'));
    }
}
