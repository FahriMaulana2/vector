<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Illuminate\Database\Seeder;

class PortfolioImageSeeder extends Seeder
{
    public function run(): void
    {
        $portfolios = Portfolio::all();

        foreach ($portfolios as $portfolio) {
            $imageCount = rand(3, 6);
            for ($i = 1; $i <= $imageCount; $i++) {
                PortfolioImage::create([
                    'portfolio_id' => $portfolio->id,
                    'image' => 'portfolios/' . $portfolio->slug . '-' . $i . '.jpg',
                    'sort_order' => $i,
                    'is_primary' => ($i === 1),
                ]);
            }
        }
    }
}