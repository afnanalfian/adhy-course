<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamAttempt extends Model
{
    protected $fillable = [
        'exam_id',
        'user_id',
        'started_at',
        'submitted_at',
        'duration_seconds',
        'score',
        'is_submitted',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'submitted_at' => 'datetime',
        'is_submitted' => 'boolean',
    ];

    /* ================= RELATIONS ================= */

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(ExamAnswer::class, 'attempt_id');
    }

    /* ================= HELPERS ================= */

    public function hasStarted(): bool
    {
        return !is_null($this->started_at);
    }

    public function hasSubmitted(): bool
    {
        return $this->is_submitted;
    }
    public function getRemainingSecondsAttribute()
    {
        if ($this->is_submitted) {
            return 0;
        }

        $startedAt = $this->started_at;
        $duration  = $this->exam->duration_minutes * 60;

        if (!$startedAt) {
            return $duration;
        }

        $elapsed = now()->diffInSeconds($startedAt);

        return max($duration - $elapsed, 0);
    }
    public function remainingSeconds(): int
    {
        $duration = $this->exam->duration_minutes * 60;
        $elapsed = $this->started_at
            ? $this->started_at->diffInSeconds(now())
            : 0;

        return max(0, $duration - $elapsed);
    }

    public function isExpired(): bool
    {
        return $this->remainingSeconds() <= 0;
    }
    public function getWorkDurationSecondsAttribute(): int
    {
        if (!$this->started_at) {
            return 0;
        }

        $end = $this->submitted_at ?? now();

        return $this->started_at->diffInSeconds($end);
    }

}
