<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    public function run(): void
    {
        HeroSection::create([
            'title' => 'Solusi Cetak & Branding Terpercaya',
            'subtitle' => 'OMAH Vector',
            'description' => 'Mitra terbaik untuk kebutuhan digital printing, packaging, dan merchandise perusahaan Anda. Kualitas premium dengan harga kompetitif.',
            'button_text' => 'Lihat Produk Kami',
            'button_link' => '/products',
            'image' => 'images/hero-bg.jpg',
            'is_active' => true,
        ]);
    }
}
