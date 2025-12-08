<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchasedMeeting extends Model
{
    protected $fillable = [
        'package_purchase_id',
        'meeting_id',
    ];

    public function purchase()
    {
        return $this->belongsTo(PackagePurchase::class, 'package_purchase_id');
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
