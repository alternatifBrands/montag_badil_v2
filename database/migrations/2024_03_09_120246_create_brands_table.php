<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('founder')->nullable();
            $table->string('owner')->nullable();
            $table->date('year')->nullable();
            $table->string('url')->nullable();
            $table->longText('description')->nullable();
            $table->string('parent_company')->nullable();
            $table->string('industry')->nullable();
            $table->string('notes')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_alternative')->default(false);
            $table->string('barcode')->nullable();
            $table->enum('status',['pending','approved','rejected'])->default('pending');
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('country_id')->nullable()->constrained('countries')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('city_id')->nullable()->constrained('cities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->nullable()->constrained('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
