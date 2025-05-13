<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

        protected $fillable = [
        'name',
        'color',
        'bg-color',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
