<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class Services extends Component
{
    public function render()
    {
        $services = Service::getActiveOrdered();

        return view('livewire.services', compact('services'));
    }
}
