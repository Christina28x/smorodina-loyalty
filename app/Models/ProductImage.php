<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

        protected $fillable = [
        'product_id',
        'image_path',
    ];

        public function product()
    {
        return $this->belongsTo(Product::class);
    }


        public function getThumbnailPath(): string
    {
        // Пример: upload/iblock/f2a/image.jpg
        $original = $this->image_path;

        if (!$original || !str_contains($original, 'upload/iblock/')) {
            return $original;
        }

        $thumb = str_replace('upload/iblock/', 'upload/resize_cache/iblock/', $original);
        $thumb = preg_replace('/([^\/]+)\.jpg$/', '52_60_2/$1.jpg', $thumb);

        return $thumb;
    }

}

