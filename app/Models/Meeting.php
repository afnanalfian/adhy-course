<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'start_datetime',
        'zoom_link',
        'recording_url',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function materials()
    {
        return $this->hasMany(MeetingMaterial::class);
    }

    public function postTest()
    {
        return $this->hasOne(MeetingPostTest::class);
    }
    public function video()
    {
        return $this->hasOne(MeetingVideo::class);
    }
}
