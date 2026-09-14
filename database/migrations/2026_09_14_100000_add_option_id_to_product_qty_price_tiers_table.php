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
        Schema::table('product_qty_price_tiers', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropUnique(['product_id', 'side_mode', 'min_qty']);
            $table->foreignId('option_id')
                ->nullable()
                ->after('product_id')
                ->constrained('product_options')
                ->nullOnDelete();
            $table->unique(['product_id', 'option_id', 'side_mode', 'min_qty'], 'product_qty_tiers_prod_opt_side_min_unique');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_qty_price_tiers', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropUnique('product_qty_tiers_prod_opt_side_min_unique');
            $table->dropForeign(['option_id']);
            $table->dropColumn('option_id');
            $table->unique(['product_id', 'side_mode', 'min_qty']);
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnDelete();
        });
    }
};
