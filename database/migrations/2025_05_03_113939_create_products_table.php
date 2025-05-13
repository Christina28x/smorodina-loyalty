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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category')->nullable();      // Например, "Тело"
            $table->string('subcategory')->nullable();   // Например, "Скрабы"
            $table->string('image')->nullable();         // Путь к картинке
            $table->integer('price');
            $table->string('volume')->nullable();        // Например, "30 ml"
            $table->text('usage')->nullable();           // Применение
            $table->text('ingredients')->nullable();     // Активные ингредиенты
            $table->text('packaging')->nullable();       // Упаковка (если есть)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
