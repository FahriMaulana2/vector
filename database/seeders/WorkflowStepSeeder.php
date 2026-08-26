<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\WorkflowStep;
use Illuminate\Database\Seeder;

class WorkflowStepSeeder extends Seeder
{
    public function run(): void
    {
        $steps = [
            ['icon' => 'message-circle', 'title' => 'Konsultasi', 'description' => 'Diskusikan kebutuhan cetak dan branding Anda dengan tim kami.'],
            ['icon' => 'file-text', 'title' => 'Penawaran', 'description' => 'Kami akan memberikan rincian harga dan estimasi waktu produksi.'],
            ['icon' => 'edit', 'title' => 'Desain', 'description' => 'Tim desainer kami akan membuatkan draft desain sesuai permintaan.'],
            ['icon' => 'check', 'title' => 'Persetujuan', 'description' => 'Anda meninjau dan menyetujui desain final sebelum dicetak.'],
            ['icon' => 'printer', 'title' => 'Produksi', 'description' => 'Proses pencetakan dan finishing dilakukan dengan standar tinggi.'],
            ['icon' => 'truck', 'title' => 'Pengiriman', 'description' => 'Pesanan Anda dikemas rapi dan dikirimkan atau siap diambil.'],
        ];

        foreach ($steps as $index => $step) {
            WorkflowStep::create(array_merge($step, [
                'step_number' => $index + 1,
                'sort_order' => $index + 1,
                'is_active' => true,
            ]));
        }
    }
}
