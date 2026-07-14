<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class ExamAttempt extends Model
{
    protected $fillable = [
        'exam_id',
        'user_id',
        'started_at',
        'submitted_at',
        'score',
        'is_passed',
        'correct_count',
        'wrong_count',
        'is_submitted',
        'paused_at',
        'total_paused_seconds',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'submitted_at' => 'datetime',
        'is_submitted' => 'boolean',
        'is_passed' => 'boolean',
        'paused_at' => 'datetime',
        'total_paused_seconds' => 'integer',
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
    /**
     * MODIFIKASI: Hitung sisa waktu dengan memperhitungkan pause
     */
    public function getRemainingSecondsAttribute()
    {
        if ($this->is_submitted) {
            return 0;
        }

        $duration = $this->exam->duration_minutes * 60;

        if (!$this->started_at) {
            return $duration;
        }

        // Jika sedang pause, hitung sampai paused_at
        $endTime = $this->isPaused() ? $this->paused_at : now();
        
        $elapsed = $endTime->diffInSeconds($this->started_at) - ($this->total_paused_seconds ?? 0);

        return max($duration - $elapsed, 0);
    }

    /**
     * MODIFIKASI: Hitung sisa waktu dengan memperhitungkan pause
     */
    public function remainingSeconds(): int
    {
        if ($this->is_submitted) {
            return 0;
        }

        $duration = $this->exam->duration_minutes * 60;
        
        // Jika sedang pause, gunakan paused_at sebagai batas waktu
        $endTime = $this->isPaused() ? $this->paused_at : now();
        
        $elapsed = $this->started_at
            ? $this->started_at->diffInSeconds($endTime) - ($this->total_paused_seconds ?? 0)
            : 0;

        return max(0, $duration - $elapsed);
    }

    /**
     * CEK APAKAH SEDANG PAUSE
     */
    public function isPaused(): bool
    {
        return !is_null($this->paused_at);
    }

    /**
     * PAUSE EXAM
     */
    public function pause(): void
    {
        if (!$this->isPaused() && !$this->is_submitted) {
            $this->update([
                'paused_at' => now(),
            ]);
        }
    }

    /**
     * RESUME EXAM
     */
    public function resume(): void
    {
        if ($this->isPaused() && !$this->is_submitted) {
            $pausedDuration = $this->paused_at->diffInSeconds(now());
            
            $this->update([
                'paused_at' => null,
                'total_paused_seconds' => ($this->total_paused_seconds ?? 0) + $pausedDuration,
            ]);
        }
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
    /* ================= HELPERS FOR NEW QUESTION TYPES ================= */

    /**
     * Get answers grouped by question type
     */
    public function answersByType(): array
    {
        return $this->answers->groupBy(fn ($a) => $a->answer_type);
    }

    /**
     * Check if attempt contains specific question type
     */
    public function hasQuestionType(string $type): bool
    {
        return $this->answers->contains(function($answer) use ($type) {
            return $answer->answer_type === $type;
        });
    }

    /**
     * Get all short answer responses
     */
    public function getShortAnswerResponses(): Collection
    {
        return $this->answers->filter(function($answer) {
            return $answer->answer_type === 'short_answer';
        })->map(function($answer) {
            return [
                'question_id' => $answer->question_id,
                'value' => $answer->short_answer_value,
                'normalized' => $answer->normalized_short_answer,
            ];
        });
    }

    /**
     * Get all compound question responses
     */
    public function getCompoundResponses(): Collection
    {
        return $this->answers->filter(function($answer) {
            return $answer->answer_type === 'compound';
        });
    }

    /**
     * Calculate score breakdown by question type
     */
    public function getScoreByType(): array
    {
        $breakdown = [];

        foreach ($this->answers as $answer) {
            $type = $answer->selected_options['type'] ?? 'unknown';

            if (!isset($breakdown[$type])) {
                $breakdown[$type] = [
                    'total' => 0,
                    'correct' => 0,
                    'score' => 0
                ];
            }

            $breakdown[$type]['total']++;

            if ($answer->is_correct) {
                $breakdown[$type]['correct']++;
            }
        }

        // Calculate percentage
        foreach ($breakdown as $type => $data) {
            $breakdown[$type]['score'] = $data['total'] > 0
                ? round(($data['correct'] / $data['total']) * 100, 2)
                : 0;
        }

        return $breakdown;
    }
}
