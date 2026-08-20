<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Standalone Content (No dependencies)
        $this->call([
            HeroSectionSeeder::class,
            HeroStatisticSeeder::class, // Depends on HeroSection
            AboutSectionSeeder::class,
            ServiceSeeder::class,
            WhyChooseUsSeeder::class,
            WorkflowStepSeeder::class,
            // FaqSeeder::class, <-- SUDAH DIHAPUS
            SettingSeeder::class,
        ]);

        // 2. Products (Depends on ProductCategory)
        $this->call([
            ProductCategorySeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class, // Depends on Product
        ]);

        // 3. Portfolios (Depends on PortfolioCategory)
        $this->call([
            PortfolioCategorySeeder::class,
            PortfolioSeeder::class,
            PortfolioImageSeeder::class, // Depends on Portfolio
        ]);
    }
}
