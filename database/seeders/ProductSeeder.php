<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [


        ];

        foreach ($products as $data) {
            $extraImages = $data['extra_images'];
            unset($data['extra_images']);

            $product = Product::create($data);

            foreach ($extraImages as $path) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }
    }
}


