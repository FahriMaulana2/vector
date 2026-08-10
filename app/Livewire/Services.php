<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;

class Services extends Component
{
    public function render()
    {
        $services = Service::getActiveOrdered();

        return view('livewire.services', compact('services'));
    }
}
