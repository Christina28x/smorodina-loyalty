<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoyaltyLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_name',
        'min_spending',
        'bonus_percent',
        'description',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
