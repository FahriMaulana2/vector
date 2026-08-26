<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\HeroSection;
use App\Models\HeroStatistic;
use Illuminate\Database\Seeder;

class HeroStatisticSeeder extends Seeder
{
    public function run(): void
    {
        $hero = HeroSection::where('is_active', true)->first();

        if (! $hero) {
            return;
        }

        $stats = [
            ['label' => 'Klien Puas', 'value' => '500+', 'icon' => 'users'],
            ['label' => 'Proyek Selesai', 'value' => '1200+', 'icon' => 'briefcase'],
            ['label' => 'Tahun Pengalaman', 'value' => '10+', 'icon' => 'clock'],
            ['label' => 'Ulasan Positif', 'value' => '98%', 'icon' => 'star'],
        ];

        foreach ($stats as $index => $stat) {
            HeroStatistic::create([
                'hero_section_id' => $hero->id,
                'label' => $stat['label'],
                'value' => $stat['value'],
                'icon' => $stat['icon'],
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }
    }
}
