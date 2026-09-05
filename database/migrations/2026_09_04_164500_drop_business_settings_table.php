<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('business_settings')) {
            Schema::dropIfExists('business_settings');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Obsolete table, no reverse needed
    }
};
