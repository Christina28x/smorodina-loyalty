<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ← Вот это важно
use Illuminate\Support\Carbon;


class SubcategorySeeder extends Seeder
{
    public function run(): void
    {
        \DB::table('loyalty_settings')->insert([
    'recommendations_enabled' => true,
    'discount_choice_enabled' => true,
    'created_at' => now(),
    'updated_at' => now(),
]);

    }
}