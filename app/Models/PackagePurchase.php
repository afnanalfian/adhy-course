<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagePurchase extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'status',
        'total_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function meetings()
    {
        return $this->hasMany(PurchasedMeeting::class);
    }

    public function proof()
    {
        return $this->hasOne(PaymentProof::class);
    }
}
