<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productable extends Model
{
    protected $fillable = [
        'product_id',
        'productable_type',
        'productable_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productable()
    {
        return $this->morphTo();
    }
}
