<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('bonus_used')->default(0);
            $table->unsignedInteger('discount_used')->default(0);
            $table->decimal('final_price', 10, 2);
            $table->unsignedInteger('total_quantity');
            $table->string('delivery_method');
            $table->timestamps(); // created_at будет датой оформления
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
