<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'type', 'value', 'min_order_amount',
        'max_uses', 'used_count', 'is_active', 'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active'  => 'boolean',
    ];

    /**
     * Check if the coupon is currently valid (not expired, not over-used, is active).
     */
    public function isValid(): bool
    {
        if (!$this->is_active) return false;
        if ($this->expires_at && $this->expires_at->isPast()) return false;
        if (!is_null($this->max_uses) && $this->used_count >= $this->max_uses) return false;
        return true;
    }

    /**
     * Calculate the discount amount for a given subtotal.
     */
    public function calculateDiscount(float $subtotal): float
    {
        if ($this->type === 'percentage') {
            return round($subtotal * ($this->value / 100));
        }
        // Fixed discount — don't exceed subtotal
        return min($this->value, $subtotal);
    }
}
