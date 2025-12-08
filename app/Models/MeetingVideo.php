<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'video_url',
        'bunny_video_id'
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
