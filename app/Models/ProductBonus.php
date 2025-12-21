<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductBonus extends Model
{
    protected $fillable = [
        'product_id',
        'bonus_type',
        'bonus_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
