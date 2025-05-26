<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'bonus_used',
        'discount_used',
        'final_price',
        'total_quantity',
        'address',
        'delivery_method',
    ];


    public function items() 
    {
        return $this->hasMany(OrderItem::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function earnedBonus()
    {
        return $this->transactions()->where('type', 'earn')->sum('amount');
    }

}
