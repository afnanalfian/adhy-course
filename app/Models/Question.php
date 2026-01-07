<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'material_id',
        'type',
        'question_text',
        'image',
        'explanation',
    ];
    public const TYPES = [
        'mcq'          => 'Pilihan Ganda',
        'mcma'         => 'Pilihan Ganda (Multi Jawaban)',
        'truefalse'    => 'Benar / Salah',
        'short_answer' => 'Isian Singkat',
        'compound'     => 'Soal Kompleks',
    ];

    public static function getAvailableTypes(): array
    {
        return self::TYPES;
    }

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? strtoupper($this->type);
    }
    public function material()
    {
        return $this->belongsTo(QuestionMaterial::class, 'material_id');
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'question_id');
    }
    public function subItems()
    {
        return $this->hasMany(QuestionSubItem::class)
            ->orderBy('order');
    }
    /* ================= HELPERS ================= */

    public function isCompound(): bool
    {
        return $this->type === 'compound';
    }

    public function isShortAnswer(): bool
    {
        return $this->type === 'short_answer';
    }
    public function isMCQ(): bool
    {
        return $this->type === 'mcq';
    }

    public function isMCMA(): bool
    {
        return $this->type === 'mcma';
    }
    public function isTrueFalse(): bool
    {
        return $this->type === 'truefalse';
    }
    public function checkCompoundAnswer(array $userAnswers): array
    {
        $results = [
            'correct' => true,
            'details' => [],
            'score' => 0
        ];

        foreach ($this->subItems as $subItem) {
            $userAnswer = $userAnswers[$subItem->id] ?? null;
            $isCorrect = $subItem->checkAnswer($userAnswer);

            $results['details'][] = [
                'sub_item_id' => $subItem->id,
                'label' => $subItem->label,
                'type' => $subItem->type,
                'user_answer' => $userAnswer,
                'correct' => $isCorrect,
                'primary_answer' => $subItem->primary_answer_text,
                'all_possible_answers' => $subItem->all_possible_answers
            ];

            if (!$isCorrect) {
                $results['correct'] = false;
            }
        }

        // Hitung skor: jika semua benar = 1, jika ada yang salah = 0
        $results['score'] = $results['correct'] ? 1 : 0;

        return $results;
    }

    public function checkShortAnswer(string $userAnswer): array
    {
        // Untuk soal isian singkat non-compound
        $correctValues = $this->options()
            ->where('is_correct', true)
            ->get()
            ->map(function ($option) {
                return QuestionSubAnswer::normalizeAnswer($option->option_text);
            })
            ->filter()
            ->values()
            ->toArray();

        $userNormalized = QuestionSubAnswer::normalizeAnswer($userAnswer);
        $isCorrect = in_array($userNormalized, $correctValues);

        return [
            'correct' => $isCorrect,
            'user_answer' => $userAnswer,
            'normalized' => $userNormalized,
            'possible_answers' => $correctValues,
            'primary_answer' => $this->options()->where('is_correct', true)->first()?->option_text
        ];
    }
}
