<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table): void {
            $table->foreignId('portfolio_category_id')
                ->nullable()
                ->after('title')
                ->constrained('portfolio_categories')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table): void {
            $table->dropForeign(['portfolio_category_id']);
            $table->dropColumn('portfolio_category_id');
        });
    }
};
