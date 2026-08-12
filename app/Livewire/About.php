<?php

namespace App\Livewire;

use App\Models\AboutSection;
use Livewire\Component;

class About extends Component
{
    public function render()
    {
        $about = AboutSection::getActive();

        return view('livewire.about', compact('about'));
    }
}
