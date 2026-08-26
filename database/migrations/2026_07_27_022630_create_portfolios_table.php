<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->string('slug')
                ->unique();

            $table->text('description')
                ->nullable();

            $table->string('image')
                ->nullable();

            $table->string('client')
                ->nullable();

            $table->date('project_date')
                ->nullable();

            $table->boolean('is_featured')
                ->default(false)
                ->index();

            $table->unsignedInteger('sort_order')
                ->default(0)
                ->index();

            $table->boolean('is_active')
                ->default(true)
                ->index();

            $table->timestamps();

            $table->index([
                'is_featured',
                'is_active',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
