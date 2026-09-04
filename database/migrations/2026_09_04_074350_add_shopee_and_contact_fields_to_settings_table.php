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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('whatsapp_number')->nullable()->after('id');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('shopee_store_name')->nullable();
            $table->string('shopee_store_url')->nullable();
            $table->string('shopee_logo_url')->nullable();
            $table->boolean('shopee_is_active')->default(true);
            $table->text('shopee_maintenance_msg')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp_number',
                'phone_number',
                'email',
                'shopee_store_name',
                'shopee_store_url',
                'shopee_logo_url',
                'shopee_is_active',
                'shopee_maintenance_msg',
            ]);
        });
    }
};
