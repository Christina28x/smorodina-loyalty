<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'city',
        'phone',
        'birthday',
        'loyalty_level_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Отправка кастомного письма подтверждения email.
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }

    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites')->withTimestamps();
    }

    public function hasFavorite($productId)
    {
        return $this->favorites()->where('product_id', $productId)->exists();
    }

    public function loyaltyLevel()
    {
        return $this->belongsTo(LoyaltyLevel::class);
    }

    public function orders() 
    {
        return $this->hasMany(Order::class);
    }

    public function transactions() 
    {
        return $this->hasMany(Transaction::class);
    }

    public function discounts() 
    {
        return $this->hasMany(Discount::class);
    }


}
