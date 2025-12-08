<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionExplanation extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'explanation'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

