<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'email',
        'first_name',
        'last_name',
        'address',
        'apartment',
        'city',
        'postal_code',
        'phone',
        'subtotal',
        'discount',
        'shipping',
        'total',
        'payment_method',
        'coupon_code',
        'status',
        'special_instructions',
        'delivered_at',
    ];

    protected $casts = [
        'delivered_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
