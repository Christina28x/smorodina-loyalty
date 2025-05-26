<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'id',
        'category_id',
        'name',
        'rus_name',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
