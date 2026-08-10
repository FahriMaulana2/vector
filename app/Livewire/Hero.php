<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\HeroSection;
use App\Models\Setting;

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

        // Slide utama dari database (1 slide hero aktif),
        // diikuti 2 slide fallback agar slider tetap berjalan seperti desain lama.
        $slides = [];

        if ($hero && $hero->getImageUrlAttribute()) {
            $slides[] = [
                'img' => $hero->getImageUrlAttribute(),
                'alt' => $hero->title,
                'label' => $hero->subtitle ?: 'Digital Printing & Branding',
            ];
        } else {
            $slides[] = [
                'img' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=900&q=80',
                'alt' => 'Digital printing equipment in modern office',
                'label' => 'Offset & Digital Printing',
            ];
        }

        // Fallback slide kedua & ketiga (desain lama)
        $slides[] = [
            'img' => 'https://images.unsplash.com/photo-1566491561884-8969e5bb19d9?auto=format&fit=crop&w=900&q=80',
            'alt' => 'Creative studio workspace with design tools',
            'label' => 'Creative Studio Workspace',
        ];
        $slides[] = [
            'img' => 'https://images.unsplash.com/photo-1516387938699-a93567ec168e?auto=format&fit=crop&w=900&q=80',
            'alt' => 'Premium custom packaging products',
            'label' => 'Premium Packaging',
        ];

        // WhatsApp link dari Settings (STEP 2) untuk CTA
        $whatsappLink = Setting::getWhatsAppLink();

        return view('livewire.hero', [
            'hero' => $hero,
            'statistics' => $statistics,
            'slides' => $slides,
            'primaryCta' => $primaryCta,
            'primaryCtaLink' => $primaryCtaLink,
            'whatsappLink' => $whatsappLink,
        ]);
    }
}

