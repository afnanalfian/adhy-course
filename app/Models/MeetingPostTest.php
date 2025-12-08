<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingPostTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'duration_minutes'
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function questions()
    {
        return $this->hasMany(MeetingPostTestQuestion::class);
    }

    public function results()
    {
        return $this->hasMany(MeetingPostTestResult::class);
    }
}
