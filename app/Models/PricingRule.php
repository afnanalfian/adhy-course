<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingRule extends Model
{
    protected $fillable = [
        'product_type',
        'min_qty',
        'max_qty',
        'price_per_unit',
        'fixed_price',
        'is_active',
    ];
    public function getPricingTypeAttribute(): string
    {
        return $this->price_per_unit !== null
            ? 'per_unit'
            : 'fixed';
    }

    public function getPriceAttribute(): float
    {
        return $this->price_per_unit ?? $this->fixed_price ?? 0;
    }
}
