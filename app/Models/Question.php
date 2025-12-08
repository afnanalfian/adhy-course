<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'question_text',
        'answer_key',
        'explanation',
    ];

    public function subject()
    {
        return $this->belongsTo(QuestionSubject::class);
    }

    public function choices()
    {
        return $this->hasMany(QuestionChoice::class);
    }

    public function explanation()
    {
        return $this->hasOne(QuestionExplanation::class);
    }
}
