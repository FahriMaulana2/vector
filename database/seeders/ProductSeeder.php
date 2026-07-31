<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ProductCategory::all()->keyBy('slug');

        $products = [
            ['product_category_id' => $categories['corporate-branding']->id, 'name' => 'Kartu Nama Premium', 'slug' => 'kartu-nama-premium', 'short_description' => 'Kartu nama dengan bahan art carton 260gr.', 'price' => 150000, 'badge' => 'Best Seller', 'is_featured' => true],
            ['product_category_id' => $categories['corporate-branding']->id, 'name' => 'Kop Surat & Amplop', 'slug' => 'kop-surat-amplop', 'short_description' => 'Stationery set untuk kesan profesional.', 'price' => 250000, 'badge' => null, 'is_featured' => false],
            ['product_category_id' => $categories['packaging']->id, 'name' => 'Paper Bag Custom', 'slug' => 'paper-bag-custom', 'short_description' => 'Paper bag dengan desain dan ukuran custom.', 'price' => 3500, 'badge' => 'Custom', 'is_featured' => true],
            ['product_category_id' => $categories['packaging']->id, 'name' => 'Box Packaging Makanan', 'slug' => 'box-packaging-makanan', 'short_description' => 'Kemasan food grade yang aman dan menarik.', 'price' => 2500, 'badge' => null, 'is_featured' => false],
            ['product_category_id' => $categories['merchandise']->id, 'name' => 'Tumbler Stainless', 'slug' => 'tumbler-stainless', 'short_description' => 'Tumbler custom logo untuk souvenir.', 'price' => 85000, 'badge' => 'Popular', 'is_featured' => true],
            ['product_category_id' => $categories['merchandise']->id, 'name' => 'Lanyard Printing', 'slug' => 'lanyard-printing', 'short_description' => 'Lanyard dengan sablon full color.', 'price' => 12000, 'badge' => null, 'is_featured' => false],
            ['product_category_id' => $categories['printing']->id, 'name' => 'Brosur Lipat Tiga', 'slug' => 'brosur-lipat-tiga', 'short_description' => 'Brosur promosi art paper 150gr.', 'price' => 1200, 'badge' => null, 'is_featured' => false],
            ['product_category_id' => $categories['printing']->id, 'name' => 'Kalender Dinding', 'slug' => 'kalender-dinding', 'short_description' => 'Kalender custom untuk hadiah akhir tahun.', 'price' => 45000, 'badge' => 'Seasonal', 'is_featured' => true],
            ['product_category_id' => $categories['signage']->id, 'name' => 'Roll Banner / X Banner', 'slug' => 'roll-banner', 'short_description' => 'Media promosi portable untuk event.', 'price' => 275000, 'badge' => null, 'is_featured' => false],
            ['product_category_id' => $categories['signage']->id, 'name' => 'Spanduk / Banner Outdoor', 'slug' => 'spanduk-outdoor', 'short_description' => 'Cetak flexi china/korea untuk outdoor.', 'price' => 25000, 'badge' => null, 'is_featured' => false],
            ['product_category_id' => $categories['invitation']->id, 'name' => 'Undangan Pernikahan Softcover', 'slug' => 'undangan-pernikahan-softcover', 'short_description' => 'Undangan elegan dengan finishing foil.', 'price' => 8500, 'badge' => 'New', 'is_featured' => true],
            ['product_category_id' => $categories['merchandise']->id, 'name' => 'Notebook Custom', 'slug' => 'notebook-custom', 'short_description' => 'Buku catatan dengan cover custom logo.', 'price' => 35000, 'badge' => null, 'is_featured' => false],
        ];

        foreach ($products as $index => $product) {
            Product::create(array_merge($product, [
                'description' => $product['short_description'] . ' Hubungi kami untuk informasi lebih lanjut mengenai spesifikasi dan pemesanan.',
                'image' => 'products/' . $product['slug'] . '.jpg',
                'sort_order' => $index + 1,
                'is_active' => true,
            ]));
        }
    }
}