<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('portfolios', 'portfolio_category_id')) {
            return;
        }

        Schema::table('portfolios', function (Blueprint $table) {
            $table->foreignId('portfolio_category_id')
                ->nullable()
                ->constrained('portfolio_categories')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->index('portfolio_category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('portfolios', 'portfolio_category_id')) {
            return;
        }

        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropIndex(['portfolio_category_id']);
            $table->dropConstrainedForeignId('portfolio_category_id');
        });
    }
};
