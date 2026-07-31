<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\WhyChooseUs;
use Illuminate\Database\Seeder;

class WhyChooseUsSeeder extends Seeder
{
    public function run(): void
    {
        $reasons = [
            ['icon' => 'users', 'title' => 'Tim Profesional', 'description' => 'Didukung oleh tim desainer dan operator mesin berpengalaman.'],
            ['icon' => 'check-circle', 'title' => 'Kualitas Premium', 'description' => 'Menggunakan bahan dan mesin cetak terbaik untuk hasil maksimal.'],
            ['icon' => 'zap', 'title' => 'Produksi Cepat', 'description' => 'Proses produksi yang efisien untuk memenuhi deadline Anda.'],
            ['icon' => 'tag', 'title' => 'Harga Kompetitif', 'description' => 'Menawarkan harga terbaik tanpa mengurangi kualitas produk.'],
            ['icon' => 'message-square', 'title' => 'Konsultasi Gratis', 'description' => 'Dapatkan saran dan solusi terbaik dari tim ahli kami secara gratis.'],
            ['icon' => 'truck', 'title' => 'Tepat Waktu', 'description' => 'Komitmen kami untuk selalu mengirimkan pesanan sesuai jadwal.'],
        ];

        foreach ($reasons as $index => $reason) {
            WhyChooseUs::create(array_merge($reason, [
                'sort_order' => $index + 1,
                'is_active' => true,
            ]));
        }
    }
}