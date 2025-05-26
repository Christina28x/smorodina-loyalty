<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoyaltySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'recommendations_enabled',
        'discount_choice_enabled',
    ];
}
