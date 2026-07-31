<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Corporate Branding', 'slug' => 'corporate-branding', 'description' => 'Kebutuhan branding untuk perusahaan dan kantor.'],
            ['name' => 'Packaging', 'slug' => 'packaging', 'description' => 'Kemasan produk yang menarik dan fungsional.'],
            ['name' => 'Invitation', 'slug' => 'invitation', 'description' => 'Undangan pernikahan, event, dan corporate.'],
            ['name' => 'Merchandise', 'slug' => 'merchandise', 'description' => 'Souvenir dan merchandise custom untuk promosi.'],
            ['name' => 'Printing', 'slug' => 'printing', 'description' => 'Layanan cetak digital dan offset berbagai media.'],
            ['name' => 'Signage', 'slug' => 'signage', 'description' => 'Papan nama, banner, dan media promosi outdoor.'],
        ];

        foreach ($categories as $index => $cat) {
            ProductCategory::create(array_merge($cat, [
                'sort_order' => $index + 1,
                'is_active' => true,
            ]));
        }
    }
}