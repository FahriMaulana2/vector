<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Banner',
            'Spanduk',
            'Sticker',
            'Kartu Nama',
            'Undangan',
            'Desain Logo',
            'Lainnya',
        ];

        foreach ($categories as $index => $name) {
            ProductCategory::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }

        $this->command->info('✅ Product categories seeded successfully!');
    }
}
