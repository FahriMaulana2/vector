<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            $imageCount = rand(3, 5);
            for ($i = 1; $i <= $imageCount; $i++) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'products/' . $product->slug . '-' . $i . '.jpg',
                    'sort_order' => $i,
                    'is_primary' => ($i === 1),
                ]);
            }
        }
    }
}