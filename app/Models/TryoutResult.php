<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TryoutResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'tryout_id',
        'user_id',
        'score',
        'answers',
        'started_at',
        'finished_at'
    ];

    protected $casts = [
        'answers' => 'array',
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function tryout()
    {
        return $this->belongsTo(Tryout::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
