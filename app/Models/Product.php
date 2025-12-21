<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'type',
        'name',
        'description',
        'is_active',
    ];

    /* ================= RELATIONS ================= */

    public function productable()
    {
        return $this->morphTo();
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function bonuses()
    {
        return $this->hasMany(ProductBonus::class);
    }
}
