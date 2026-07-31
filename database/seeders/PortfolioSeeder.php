<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $categories = PortfolioCategory::all()->keyBy('slug');

        $portfolios = [
            ['portfolio_category_id' => $categories['corporate']->id, 'title' => 'Rebranding PT Maju Jaya', 'slug' => 'rebranding-pt-maju-jaya', 'client' => 'PT Maju Jaya', 'project_date' => '2023-05-15', 'is_featured' => true],
            ['portfolio_category_id' => $categories['packaging']->id, 'title' => 'Packaging Kopi Senja', 'slug' => 'packaging-kopi-senja', 'client' => 'Kopi Senja', 'project_date' => '2023-06-20', 'is_featured' => true],
            ['portfolio_category_id' => $categories['wedding']->id, 'title' => 'Undangan Pernikahan Custom', 'slug' => 'undangan-pernikahan-custom', 'client' => 'Budi & Dewi', 'project_date' => '2023-07-10', 'is_featured' => false],
            ['portfolio_category_id' => $categories['restaurant']->id, 'title' => 'Menu & Branding Restaurant Padang', 'slug' => 'menu-branding-restaurant', 'client' => 'RM Padang Sederhana', 'project_date' => '2023-08-05', 'is_featured' => true],
            ['portfolio_category_id' => $categories['retail']->id, 'title' => 'Signage Toko Baju', 'slug' => 'signage-toko-baju', 'client' => 'Boutique Mawar', 'project_date' => '2023-09-12', 'is_featured' => false],
            ['portfolio_category_id' => $categories['event']->id, 'title' => 'Backdrop & Merchandise Event', 'slug' => 'backdrop-merchandise-event', 'client' => 'Startup Tech', 'project_date' => '2023-10-01', 'is_featured' => true],
            ['portfolio_category_id' => $categories['school']->id, 'title' => 'Buku Tahunan Sekolah', 'slug' => 'buku-tahunan-sekolah', 'client' => 'SMA Global', 'project_date' => '2023-11-15', 'is_featured' => false],
            ['portfolio_category_id' => $categories['government']->id, 'title' => 'Cetak Dokumen Resmi', 'slug' => 'cetak-dokumen-resmi', 'client' => 'Dinas Pendidikan', 'project_date' => '2023-12-01', 'is_featured' => false],
            ['portfolio_category_id' => $categories['corporate']->id, 'title' => 'Company Profile Book', 'slug' => 'company-profile-book', 'client' => 'CV Berkah Abadi', 'project_date' => '2024-01-10', 'is_featured' => true],
            ['portfolio_category_id' => $categories['merchandise']->id, 'title' => 'Merchandise Akhir Tahun', 'slug' => 'merchandise-akhir-tahun', 'client' => 'Bank Nasional', 'project_date' => '2024-01-25', 'is_featured' => false],
            ['portfolio_category_id' => $categories['packaging']->id, 'title' => 'Box Kue Lebaran', 'slug' => 'box-kue-lebaran', 'client' => 'Nastar Queen', 'project_date' => '2024-02-14', 'is_featured' => true],
            ['portfolio_category_id' => $categories['wedding']->id, 'title' => 'Dekorasi & Souvenir Wedding', 'slug' => 'dekorasi-souvenir-wedding', 'client' => 'Andi & Rina', 'project_date' => '2024-03-05', 'is_featured' => false],
            ['portfolio_category_id' => $categories['restaurant']->id, 'title' => 'Kemasan Takeaway', 'slug' => 'kemasan-takeaway', 'client' => 'Burger Bang Jago', 'project_date' => '2024-03-20', 'is_featured' => true],
            ['portfolio_category_id' => $categories['retail']->id, 'title' => 'Paper Bag Premium', 'slug' => 'paper-bag-premium', 'client' => 'Skincare Alami', 'project_date' => '2024-04-10', 'is_featured' => false],
            ['portfolio_category_id' => $categories['event']->id, 'title' => 'Spanduk & Flyer Kampanye', 'slug' => 'spanduk-flyer-kampanye', 'client' => 'LSM Lingkungan', 'project_date' => '2024-04-22', 'is_featured' => false],
            ['portfolio_category_id' => $categories['school']->id, 'title' => 'Kalender Akademik', 'slug' => 'kalender-akademik', 'client' => 'Universitas Indonesia', 'project_date' => '2024-05-01', 'is_featured' => true],
            ['portfolio_category_id' => $categories['government']->id, 'title' => 'Papan Nama Instansi', 'slug' => 'papan-nama-instansi', 'client' => 'Kecamatan Menteng', 'project_date' => '2024-05-15', 'is_featured' => false],
            ['portfolio_category_id' => $categories['corporate']->id, 'title' => 'ID Card & Lanyard', 'slug' => 'id-card-lanyard', 'client' => 'PT Telekomunikasi', 'project_date' => '2024-06-01', 'is_featured' => true],
            ['portfolio_category_id' => $categories['packaging']->id, 'title' => 'Label Produk Kosmetik', 'slug' => 'label-produk-kosmetik', 'client' => 'Glow Beauty', 'project_date' => '2024-06-20', 'is_featured' => false],
            ['portfolio_category_id' => $categories['restaurant']->id, 'title' => 'Placemat & Coaster', 'slug' => 'placemat-coaster', 'client' => 'Cafe Senja', 'project_date' => '2024-07-05', 'is_featured' => true],
        ];

        foreach ($portfolios as $index => $portfolio) {
            Portfolio::create(array_merge($portfolio, [
                'description' => 'Proyek ' . $portfolio['title'] . ' untuk klien ' . $portfolio['client'] . '. Kami memberikan solusi terbaik sesuai kebutuhan branding mereka.',
                'image' => 'portfolios/' . $portfolio['slug'] . '.jpg',
                'sort_order' => $index + 1,
                'is_active' => true,
            ]));
        }
    }
}