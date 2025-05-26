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
        Schema::table('loyalty_levels', function (Blueprint $table) {
            $table->unsignedTinyInteger('bonus_percent')->after('min_spending'); // 2, 4, 6
            $table->text('description')->nullable()->after('bonus_percent'); // Можно хранить HTML
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loyalty_levels', function (Blueprint $table) {
            //
        });
    }
};
