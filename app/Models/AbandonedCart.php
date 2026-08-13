<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbandonedCart extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'cart_data',
        'total_value',
        'funnel_step',
        'generated_coupon_id',
        'last_active_at',
    ];

    protected $casts = [
        'cart_data' => 'array',
        'last_active_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'generated_coupon_id');
    }
}
