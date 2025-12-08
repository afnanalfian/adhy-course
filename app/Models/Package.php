<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name',
        'description',
        'min_meetings',
        'max_meetings',
        'price_per_meeting',
        'fixed_price',
        'include_daily_quiz',
        'include_tryout'
    ];
    protected $casts = [
        'include_daily_quiz' => 'boolean',
        'include_tryout' => 'boolean',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function purchases()
    {
        return $this->hasMany(PackagePurchase::class);
    }
}

