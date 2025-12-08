<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingPostTestQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_test_id',
        'question_id'
    ];

    public function postTest()
    {
        return $this->belongsTo(MeetingPostTest::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

