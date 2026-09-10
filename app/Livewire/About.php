<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\AboutMilestone;
use App\Models\AboutSection;
use App\Models\AboutStat;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class About extends Component
{
    public function render(): View
    {
        $about = AboutSection::getActive();
        $stats = AboutStat::getActive();
        $milestones = AboutMilestone::getActive();

        return view('livewire.about', compact('about', 'stats', 'milestones'))->layout('components.layouts.app');
    }
}
