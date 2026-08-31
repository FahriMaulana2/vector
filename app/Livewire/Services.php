<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class Services extends Component
{
    public $activeCardId = null;

    public function toggleCard($id)
    {
        // Toggle: jika sudah aktif, matikan; jika belum, aktifkan
        $this->activeCardId = $this->activeCardId === $id ? null : $id;
    }

    public function render()
    {
        $services = Service::getActiveOrdered();
        
        return view('livewire.services', [
            'services' => $services
        ]);
    }
}