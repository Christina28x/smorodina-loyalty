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
        'type',        // 'category', 'subcategory', 'all', и т.д.
        'target_id',   // ID категории/подкатегории (если применимо)
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
        if ($this->type === 'subcategory') {
            return $this->belongsTo(Subcategory::class, 'target_id');
        } elseif ($this->type === 'category') {
            return $this->belongsTo(Category::class, 'target_id');
        }

        return null;
    }

    // Проверка истечения срока действия
    public function isExpired()
    {
        return now()->greaterThan($this->valid_until);
    }
}
