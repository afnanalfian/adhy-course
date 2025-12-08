<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentProof extends Model
{
    protected $fillable = ['package_purchase_id', 'file_path'];

    public function purchase()
    {
        return $this->belongsTo(PackagePurchase::class);
    }
}
