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
        Schema::table('orders', function (Blueprint $table) {
            $table->text('shipping_address')->nullable()->after('customer_email');
            $table->enum('design_file_status', ['ready', 'need_design_help'])->default('ready')->after('shipping_address');
            $table->decimal('subtotal', 14, 2)->default(0)->after('design_file_status');
            $table->boolean('has_manual_quote_item')->default(false)->after('subtotal');
            $table->unsignedInteger('quantity')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_address',
                'design_file_status',
                'subtotal',
                'has_manual_quote_item',
            ]);
            $table->unsignedInteger('quantity')->default(1)->change();
        });
    }
};
