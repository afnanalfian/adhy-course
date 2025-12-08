<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TryoutQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'tryout_id',
        'question_id'
    ];

    public function tryout()
    {
        return $this->belongsTo(Tryout::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
