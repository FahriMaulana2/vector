<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PortfolioCategory;
use Illuminate\Database\Seeder;

class PortfolioCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Branding', 'slug' => 'corporate'],
            ['name' => 'Packaging', 'slug' => 'packaging'],
            ['name' => 'Invitation Design', 'slug' => 'wedding'],
            ['name' => 'Printing', 'slug' => 'printing'],
            ['name' => 'Restaurant', 'slug' => 'restaurant'],
            ['name' => 'Retail', 'slug' => 'retail'],
            ['name' => 'Event', 'slug' => 'event'],
            ['name' => 'School', 'slug' => 'school'],
            ['name' => 'Government', 'slug' => 'government'],
            ['name' => 'Merchandise', 'slug' => 'merchandise'],
        ];

        foreach ($categories as $sortOrder => $category) {
            PortfolioCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'sort_order' => $sortOrder + 1,
                    'is_active' => true,
                ],
            );
        }
    }
}
