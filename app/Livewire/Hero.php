<?php

namespace App\Livewire;

use App\Models\HeroSection;
use App\Models\Setting;
use Livewire\Component;

class Hero extends Component
{
    public function render()
    {
        // Ambil hero aktif (model ini memastikan hanya SATU hero aktif)
        $hero = HeroSection::getActive();

        if ($hero) {
            // Statistik dari database, hanya yang aktif & terurut
            $statistics = $hero->statistics()->active()->ordered()->get();
        } else {
            $statistics = collect();
        }

        // CTA utama dari HeroSection (button_text + button_link)
        $primaryCta = null;
        $primaryCtaLink = null;
        if ($hero && $hero->button_text) {
            $primaryCta = $hero->button_text;
            $primaryCtaLink = $hero->button_link ?: '#contact';
        }

        // Gambar tunggal dari database (HeroSection aktif di admin)
        $heroImage = null;
        if ($hero && $hero->image_url) {
            $heroImage = $hero->image_url;
        } else {
            $heroImage = 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=900&q=80';
        }

        $heroImageAlt = $hero?->title ?: 'OMH Vector Digital Printing';
        $heroBadge = $hero?->subtitle ?: 'Digital Printing & Branding';

        // WhatsApp link dari Settings untuk CTA
        $whatsappLink = Setting::getWhatsAppLink();

        return view('livewire.hero', [
            'hero' => $hero,
            'statistics' => $statistics,
            'heroImage' => $heroImage,
            'heroImageAlt' => $heroImageAlt,
            'heroBadge' => $heroBadge,
            'primaryCta' => $primaryCta,
            'primaryCtaLink' => $primaryCtaLink,
            'whatsappLink' => $whatsappLink,
        ]);
    }
}
