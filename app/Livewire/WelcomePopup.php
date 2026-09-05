<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\PopupCampaign;
use Livewire\Component;

class WelcomePopup extends Component
{
    public ?PopupCampaign $campaign = null;

    public bool $viewRecorded = false;

    public function mount(): void
    {
        $this->campaign = PopupCampaign::getActiveCampaign();
    }

    public function recordView(): void
    {
        if ($this->campaign && ! $this->viewRecorded) {
            $this->campaign->incrementView();
            $this->viewRecorded = true;
        }
    }

    public function recordClick(): void
    {
        if ($this->campaign) {
            $this->campaign->incrementClick();
        }
    }

    public function render()
    {
        return view('livewire.welcome-popup');
    }
}
