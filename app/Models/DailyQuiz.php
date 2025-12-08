<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyQuiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'available_date',
        'start_time',
        'end_time',
    ];

    public function questions()
    {
        return $this->hasMany(DailyQuizQuestion::class);
    }
    public function results()
    {
        return $this->hasMany(DailyQuizResult::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
