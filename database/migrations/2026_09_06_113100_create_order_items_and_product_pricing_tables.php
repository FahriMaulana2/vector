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
        Schema::table('products', function (Blueprint $table) {
            $table->string('pricing_mode')->default('standard')->after('price');
            $table->enum('base_price_unit', ['pcs', 'lembar', 'm2'])->default('pcs')->after('pricing_mode');
            $table->boolean('requires_area_calculation')->default(false)->after('base_price_unit');
            $table->boolean('supports_2_sisi')->default(false)->after('requires_area_calculation');
            $table->string('available_widths_note')->nullable()->after('supports_2_sisi');
            $table->unsignedInteger('min_qty')->default(1)->after('available_widths_note');
            $table->unsignedInteger('qty_increment')->nullable()->default(1)->after('min_qty');
        });

        Schema::create('product_qty_price_tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();
            $table->enum('side_mode', ['1_muka', '2_muka'])->default('1_muka');
            $table->unsignedInteger('min_qty');
            $table->decimal('price_per_unit', 12, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['product_id', 'side_mode', 'min_qty']);
        });

        Schema::create('product_option_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();
            $table->string('name');
            $table->string('type')->default('radio');
            $table->boolean('is_required')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['product_id', 'sort_order']);
        });

        Schema::create('product_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_option_group_id')
                ->constrained('product_option_groups')
                ->cascadeOnDelete();
            $table->string('name');
            $table->enum('price_mode', ['delta', 'absolute'])->default('delta');
            $table->enum('price_unit', ['flat', 'per_length_m'])->default('flat');
            $table->decimal('price_delta', 12, 2)->default(0);
            $table->boolean('requires_manual_quote')->default(false);
            $table->boolean('is_default')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['product_option_group_id', 'sort_order']);
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();
            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();
            $table->string('product_name');
            $table->decimal('base_price_snapshot', 12, 2)->default(0);
            $table->json('selected_options')->nullable();
            $table->decimal('options_total', 12, 2)->default(0);
            $table->decimal('unit_price', 12, 2)->default(0);
            $table->unsignedInteger('qty')->default(1);
            $table->decimal('line_subtotal', 12, 2)->default(0);
            $table->string('side_mode')->nullable();
            $table->decimal('length_m', 8, 2)->nullable();
            $table->decimal('width_m', 8, 2)->nullable();
            $table->boolean('manual_quote_flag')->default(false);
            $table->text('manual_quote_note')->nullable();
            $table->decimal('manual_quote_amount', 12, 2)->nullable();
            $table->timestamps();

            $table->index(['order_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('product_options');
        Schema::dropIfExists('product_option_groups');
        Schema::dropIfExists('product_qty_price_tiers');

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'pricing_mode',
                'base_price_unit',
                'requires_area_calculation',
                'supports_2_sisi',
                'available_widths_note',
                'min_qty',
                'qty_increment',
            ]);
        });
    }
};
