<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\AboutMilestone;
use App\Models\AboutStat;
use Illuminate\Database\Seeder;

class AboutStatAndMilestoneSeeder extends Seeder
{
    public function run(): void
    {
        // 4 Statistik
        $stats = [
            ['label' => 'Klien Puas', 'value' => '1.500+', 'sort_order' => 1, 'is_active' => true],
            ['label' => 'Proyek Selesai', 'value' => '3.200+', 'sort_order' => 2, 'is_active' => true],
            ['label' => 'Tahun Pengalaman', 'value' => '6+', 'sort_order' => 3, 'is_active' => true],
            ['label' => 'Rating Pelanggan', 'value' => '4.9/5', 'sort_order' => 4, 'is_active' => true],
        ];

        foreach ($stats as $stat) {
            AboutStat::firstOrCreate(['label' => $stat['label']], $stat);
        }

        // Timeline Milestones
        $milestones = [
            [
                'year' => 2019,
                'title' => 'Awal Berdiri OMAH Vector',
                'description' => 'Mulai beroperasi sebagai studio desain grafis & digital printing kreatif di Surakarta.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'year' => 2021,
                'title' => 'Modernisasi Mesin & Kapasitas Cetak',
                'description' => 'Menghadirkan mesin cetak indoor dan outdoor beresolusi tinggi untuk memenuhi pesanan corporate.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'year' => 2024,
                'title' => 'Integrasi Layanan Digital & E-Commerce',
                'description' => 'Memperluas jangkauan layanan melalui marketplace resmi dan platform pemesanan online otomatis.',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($milestones as $milestone) {
            AboutMilestone::firstOrCreate(['year' => $milestone['year'], 'title' => $milestone['title']], $milestone);
        }
    }
}
