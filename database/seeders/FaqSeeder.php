<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Berapa lama proses pengerjaan pesanan?',
                'answer' => 'Waktu pengerjaan bervariasi tergantung jenis produk dan jumlah pesanan. Untuk produk standar seperti kartu nama atau stiker, biasanya memakan waktu 2-3 hari kerja. Untuk pesanan custom atau dalam jumlah besar, estimasi waktu akan dikonfirmasi saat konsultasi.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah bisa request desain custom?',
                'answer' => 'Tentu saja! Tim desainer kami siap membantu mewujudkan ide Anda. Anda bisa memberikan konsep dasar, referensi, atau brief lengkap, dan kami akan buatkan desain yang sesuai dengan identitas brand Anda.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah ada minimal order (MOQ)?',
                'answer' => 'Untuk beberapa produk digital printing, kami menerima satuan. Namun, untuk produk sablon atau merchandise custom, biasanya terdapat Minimal Order Quantity (MOQ) yang bervariasi. Silakan hubungi kami untuk detailnya.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana cara melakukan pembayaran?',
                'answer' => 'Kami menerima pembayaran melalui transfer bank (BCA, Mandiri, BNI) dan e-wallet. Untuk pesanan besar, biasanya kami meminta uang muka (DP) sebesar 50% sebelum produksi dimulai.',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
