<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PortfolioCategory;
use Illuminate\Database\Seeder;

class PortfolioCategorySeeder extends Seeder
{
    public function run(): void
    {
      $categories = [
    [
        'name' => 'Corporate',
        'slug' => 'corporate',
        'description' => 'Branding dan printing untuk perusahaan.',
    ],
    [
        'name' => 'Packaging',
        'slug' => 'packaging',
        'description' => 'Desain dan produksi kemasan untuk berbagai produk.',
    ],
    [
        'name' => 'Event',
        'slug' => 'event',
        'description' => 'Dokumentasi dan kebutuhan printing untuk berbagai event.',
    ],
    [
        'name' => 'Wedding',
        'slug' => 'wedding',
        'description' => 'Undangan, souvenir, dan kebutuhan pernikahan.',
    ],
    [
        'name' => 'Restaurant',
        'slug' => 'restaurant',
        'description' => 'Branding, menu, dan kebutuhan promosi usaha kuliner.',
    ],
    [
        'name' => 'Retail',
        'slug' => 'retail',
        'description' => 'Packaging, signage, dan kebutuhan branding untuk retail.',
    ],
    [
        'name' => 'School',
        'slug' => 'school',
        'description' => 'Alat peraga, buku tahunan, dan kebutuhan branding sekolah.',
    ],
    [
        'name' => 'Government',
        'slug' => 'government',
        'description' => 'Proyek printing untuk instansi pemerintah.',
    ],
    [
        'name' => 'Merchandise',
        'slug' => 'merchandise',
        'description' => 'Produk merchandise, souvenir, dan kebutuhan promosi.',
    ],
];

        foreach ($categories as $index => $cat) {
            PortfolioCategory::create(array_merge($cat, [
                'sort_order' => $index + 1,
                'is_active' => true,
            ]));
        }
    }
}