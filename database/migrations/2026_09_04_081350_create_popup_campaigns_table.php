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
        Schema::create('popup_campaigns', function (Blueprint $table) {
            $table->id();
            $table->enum('template_type', ['hybrid_canva', 'code_flash_sale', 'code_welcome']);
            $table->string('image_path')->nullable();
            $table->string('title', 50);
            $table->string('description', 150);
            $table->enum('cta_type', ['marketplace', 'whatsapp', 'custom_url']);
            $table->foreignId('marketplace_id')->nullable()->constrained('marketplaces')->nullOnDelete();
            $table->string('cta_url')->nullable();
            $table->string('cta_text');
            $table->boolean('is_active')->default(false);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->unsignedInteger('view_count')->default(0);
            $table->unsignedInteger('click_count')->default(0);
            $table->timestamps();

            $table->index('is_active');
            $table->index(['starts_at', 'ends_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('popup_campaigns');
    }
};
