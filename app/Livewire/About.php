<?php

namespace App\Livewire;

use App\Models\AboutSection;
use App\Models\Setting;
use Livewire\Component;

class About extends Component
{
    public bool $isAboutPage = false;

    public function mount(): void
    {
        $this->isAboutPage = request()->routeIs('about');
    }

    public function render()
    {
        $about = AboutSection::getActive();

        $view = view($this->isAboutPage ? 'livewire.about-page' : 'livewire.about', [
            'about' => $about,
            'whatsappLink' => Setting::getWhatsAppLink(
                'Halo, saya ingin berkonsultasi mengenai kebutuhan cetak dan branding.'
            ),
        ]);

        return $this->isAboutPage
            ? $view->layout('components.layouts.app')
            : $view;
    }
}
