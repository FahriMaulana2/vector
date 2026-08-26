<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['icon' => 'printer', 'title' => 'Digital Printing', 'description' => 'Cetak cepat dengan kualitas tinggi untuk kebutuhan mendesak Anda.'],
            ['icon' => 'pen-tool', 'title' => 'Graphic Design', 'description' => 'Layanan desain grafis profesional untuk logo, brosur, dan materi promosi.'],
            ['icon' => 'award', 'title' => 'Brand Identity', 'description' => 'Membangun identitas merek yang kuat dan konsisten untuk bisnis Anda.'],
            ['icon' => 'package', 'title' => 'Packaging Design', 'description' => 'Desain dan cetak kemasan produk yang menarik dan fungsional.'],
            ['icon' => 'layers', 'title' => 'Offset Printing', 'description' => 'Solusi cetak massal dengan biaya lebih efisien untuk jumlah besar.'],
            ['icon' => 'image', 'title' => 'Large Format Printing', 'description' => 'Cetak banner, spanduk, dan billboard ukuran besar dengan resolusi tajam.'],
            ['icon' => 'shopping-bag', 'title' => 'Merchandise', 'description' => 'Produksi merchandise custom seperti tumbler, kaos, dan souvenir.'],
            ['icon' => 'message-circle', 'title' => 'Consultation', 'description' => 'Konsultasi gratis untuk menentukan solusi printing terbaik bagi bisnis Anda.'],
        ];

        foreach ($services as $index => $service) {
            Service::create(array_merge($service, [
                'sort_order' => $index + 1,
                'is_active' => true,
            ]));
        }
    }
}
