<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyQuizResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'daily_quiz_id',
        'user_id',
        'score',
        'answers',
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    public function quiz()
    {
        return $this->belongsTo(DailyQuiz::class, 'daily_quiz_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
