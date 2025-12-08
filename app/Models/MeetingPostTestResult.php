<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingPostTestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_test_id',
        'user_id',
        'score',
        'answers', // JSON
        'started_at',
        'finished_at'
    ];

    protected $casts = [
        'answers' => 'array',
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function postTest()
    {
        return $this->belongsTo(MeetingPostTest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

