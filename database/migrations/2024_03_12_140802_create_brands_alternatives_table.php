<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands_alternatives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('alternative_id')->constrained('brand_alternatives')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(['brand_id', 'alternative_id']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('brands_alternatives');
    }
};
