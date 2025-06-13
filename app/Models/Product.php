<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description_short',
        'description',
        'category_id',
        'subcategory_id',
        'usage',
        'ingredients',
        'packaging',
        'image',
        'price',
        'volume',
        'slug',
    ];

    // Автоматическая генерация slug при создании
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    // Связь с изображениями
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

   public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

}

