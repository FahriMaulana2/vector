<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Migrasi data dulu (jika kolom lama masih ada dan berisi data)
        if (Schema::hasColumn('settings', 'shopee_store_name')) {
            $shopee = DB::table('settings')
                ->whereNotNull('shopee_store_name')
                ->first();

            if ($shopee && ! DB::table('marketplaces')->where('platform', 'shopee')->exists()) {
                DB::table('marketplaces')->insert([
                    'platform' => 'shopee',
                    'store_name' => $shopee->shopee_store_name,
                    'store_url' => $shopee->shopee_store_url,
                    'logo_url' => $shopee->shopee_logo_url,
                    'is_active' => $shopee->shopee_is_active ?? true,
                    'maintenance_message' => $shopee->shopee_maintenance_msg,
                    'display_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Migrasi kontak fallback ke business_settings juga
            $contactRow = DB::table('settings')
                ->whereNotNull('whatsapp_number')
                ->orWhereNotNull('phone_number')
                ->orWhereNotNull('email')
                ->first();

            if ($contactRow && ! DB::table('business_settings')->exists()) {
                DB::table('business_settings')->insert([
                    'primary_whatsapp' => $contactRow->whatsapp_number ?? null,
                    'secondary_phone' => $contactRow->phone_number ?? null,
                    'fallback_email' => $contactRow->email ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 2. Baru drop kolom lama
        Schema::table('settings', function (Blueprint $table) {
            $columnsToDrop = [
                'whatsapp_number',
                'phone_number',
                'email',
                'shopee_store_name',
                'shopee_store_url',
                'shopee_logo_url',
                'shopee_is_active',
                'shopee_maintenance_msg',
            ];

            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('settings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('whatsapp_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('shopee_store_name')->nullable();
            $table->string('shopee_store_url')->nullable();
            $table->string('shopee_logo_url')->nullable();
            $table->boolean('shopee_is_active')->default(true);
            $table->text('shopee_maintenance_msg')->nullable();
        });
    }
};
