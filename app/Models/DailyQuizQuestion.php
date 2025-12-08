<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyQuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'daily_quiz_id',
        'question_id'
    ];

    public function quiz()
    {
        return $this->belongsTo(DailyQuiz::class, 'daily_quiz_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
