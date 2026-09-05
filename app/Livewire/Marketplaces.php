<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\BusinessSetting;
use App\Models\Marketplace;
use Livewire\Component;

class Marketplaces extends Component
{
    public function render()
    {
        $marketplaces = Marketplace::query()
            ->orderBy('display_order')
            ->orderBy('id')
            ->get();

        $availablePlatforms = Marketplace::getAvailablePlatforms();
        $whatsappUrl = BusinessSetting::getCached()->getWhatsAppUrl();

        return view('livewire.marketplaces', compact('marketplaces', 'availablePlatforms', 'whatsappUrl'));
    }
}
