<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['question' => 'Berapa lama proses produksi untuk cetak brosur?', 'answer' => 'Proses produksi standar memakan waktu 3-5 hari kerja. Untuk kebutuhan mendesak, kami menyediakan layanan express 1-2 hari kerja.'],
            ['question' => 'Apakah saya bisa meminta revisi desain?', 'answer' => 'Tentu! Kami memberikan layanan revisi desain hingga 3 kali secara gratis sebelum masuk ke tahap produksi.'],
            ['question' => 'Berapa minimum order untuk cetak packaging?', 'answer' => 'Minimum order untuk custom packaging adalah 100 pcs. Namun, kami juga menerima pesanan dalam jumlah lebih kecil dengan penyesuaian harga.'],
            ['question' => 'Format file apa yang diterima untuk desain?', 'answer' => 'Kami menerima file dalam format AI, PDF, CDR, PSD, dan JPG dengan resolusi minimal 300 DPI untuk hasil cetak terbaik.'],
            ['question' => 'Apakah ada biaya konsultasi desain?', 'answer' => 'Konsultasi awal bersifat gratis. Jika Anda membutuhkan jasa desain grafis dari tim kami, akan dikenakan biaya desain yang diinformasikan di awal.'],
            ['question' => 'Bagaimana cara melakukan pemesanan?', 'answer' => 'Anda bisa memilih produk di website kami, mengisi form order, dan melanjutkan komunikasi serta pembayaran melalui WhatsApp.'],
            ['question' => 'Apakah bisa cetak dalam jumlah sedikit?', 'answer' => 'Ya, kami menggunakan mesin digital printing yang memungkinkan cetak dalam jumlah sedikit (bahkan 1 pcs) dengan kualitas tetap tinggi.'],
            ['question' => 'Apakah ada layanan pengiriman?', 'answer' => 'Ya, kami bekerja sama dengan berbagai ekspedisi untuk pengiriman ke seluruh Indonesia. Ongkos kirim ditanggung oleh pelanggan.'],
            ['question' => 'Bagaimana jika hasil cetak tidak sesuai dengan desain?', 'answer' => 'Kami akan melakukan pengecekan kualitas (QC) sebelum barang dikirim. Jika ada kesalahan dari pihak kami, kami akan mencetak ulang secara gratis.'],
            ['question' => 'Apakah bisa cetak dengan bahan khusus?', 'answer' => 'Tentu, kami memiliki berbagai pilihan bahan seperti art paper, art carton, matte paper, glossy, dan bahan specialty lainnya.'],
            ['question' => 'Bagaimana cara pembayaran?', 'answer' => 'Pembayaran dapat dilakukan melalui transfer bank (BCA, Mandiri, BNI) atau e-wallet. DP 50% diperlukan sebelum produksi dimulai.'],
            ['question' => 'Apakah harga sudah termasuk PPN?', 'answer' => 'Harga yang tertera di website belum termasuk PPN 11%. Jika Anda membutuhkan faktur pajak, silakan informasikan kepada admin kami.'],
            ['question' => 'Berapa lama garansi hasil cetak?', 'answer' => 'Kami memberikan garansi untuk kesalahan produksi. Namun, kerusakan akibat faktor eksternal setelah barang diterima tidak termasuk garansi.'],
            ['question' => 'Apakah bisa mengambil pesanan langsung di lokasi?', 'answer' => 'Ya, Anda bisa mengambil pesanan langsung di workshop kami setelah barang selesai diproduksi dan dikonfirmasi oleh admin.'],
            ['question' => 'Apakah ada diskon untuk pesanan jumlah besar?', 'answer' => 'Ya, kami memberikan harga khusus dan diskon untuk pemesanan dalam jumlah besar (wholesale). Silakan hubungi admin untuk penawaran.'],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::create(array_merge($faq, [
                'sort_order' => $index + 1,
                'is_active' => true,
            ]));
        }
    }
}