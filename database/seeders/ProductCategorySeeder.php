<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Corporate Branding', 'slug' => 'corporate-branding'],
            ['name' => 'Packaging', 'slug' => 'packaging'],
            ['name' => 'Merchandise', 'slug' => 'merchandise'],
            ['name' => 'Printing', 'slug' => 'printing'],
            ['name' => 'Signage', 'slug' => 'signage'],
            ['name' => 'Invitation', 'slug' => 'invitation'],
            ['name' => 'Lainnya', 'slug' => 'lainnya'],
        ];

        foreach ($categories as $index => $category) {
            ProductCategory::firstOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        $this->command->info('✅ Product categories seeded successfully!');
    }
}
