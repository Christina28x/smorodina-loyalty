<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('categories')->insert([
    ['id' => 1, 'name' => 'promotions', 'rus_name' => 'наборы', 'created_at' => now(), 'updated_at' => now()],
    ['id' => 2, 'name' => 'face', 'rus_name' => 'лицо', 'created_at' => now(), 'updated_at' => now()],
    ['id' => 3, 'name' => 'body', 'rus_name' => 'тело', 'created_at' => now(), 'updated_at' => now()],
    ['id' => 4, 'name' => 'hair-care', 'rus_name' => 'волосы', 'created_at' => now(), 'updated_at' => now()],
    ['id' => 5, 'name' => 'tverdye-produkty', 'rus_name' => 'твердые продукты', 'created_at' => now(), 'updated_at' => now()],
    ['id' => 6, 'name' => 'aromatherapy', 'rus_name' => 'свечи и ароматерапия', 'created_at' => now(), 'updated_at' => now()],
    ]);
    }
}
