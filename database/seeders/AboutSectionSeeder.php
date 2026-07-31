<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\AboutSection;
use Illuminate\Database\Seeder;

class AboutSectionSeeder extends Seeder
{
    public function run(): void
    {
        AboutSection::create([
            'title' => 'Tentang OMH Vector',
            'subtitle' => 'Mitra Branding & Printing Profesional',
            'description' => 'OMH Vector adalah perusahaan yang bergerak di bidang digital printing, graphic design, dan corporate branding. Kami berkomitmen memberikan hasil cetak berkualitas tinggi dengan pelayanan terbaik untuk mendukung kesuksesan bisnis Anda.',
            'vision' => 'Menjadi perusahaan printing dan branding terdepan di Indonesia yang mengutamakan kualitas, inovasi, dan kepuasan pelanggan.',
            'mission' => '1. Memberikan produk cetak berkualitas premium.\n2. Menyediakan layanan desain grafis yang inovatif.\n3. Mengutamakan ketepatan waktu dan kepuasan pelanggan.',
            'image' => 'images/about-us.jpg',
            'years_experience' => 10,
            'is_active' => true,
        ]);
    }
}