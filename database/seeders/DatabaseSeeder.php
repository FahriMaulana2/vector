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
        // Standalone Content (No dependencies)
        $this->call([
            HeroSectionSeeder::class,
            HeroStatisticSeeder::class, // Depends on HeroSection
            AboutSectionSeeder::class,
            ServiceSeeder::class,
            WhyChooseUsSeeder::class,
            WorkflowStepSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            SettingSeeder::class,
        ]);

        // Products (Depends on ProductCategory)
        $this->call([
            ProductCategorySeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class, // Depends on Product
        ]);

        // Portfolios (Depends on PortfolioCategory)
        $this->call([
            PortfolioCategorySeeder::class,
            PortfolioSeeder::class,
            PortfolioImageSeeder::class, // Depends on Portfolio
        ]);
    }
}