<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'target_id',   // ID категории
        'value',       // Скидка в процентах
        'valid_until'
    ];

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Получение целевого объекта скидки (категория или подкатегория)
    public function target()
    {
        return $this->belongsTo(Category::class, 'target_id');
    }

    // Проверка истечения срока действия
    public function isExpired()
    {
        return now()->greaterThan($this->valid_until);
    }
}
