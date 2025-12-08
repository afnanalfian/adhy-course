<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Collection;

class Leaderboard
{
    /**
     * Ranking Tryout berdasarkan tryout_id.
     */
    public static function tryout($tryoutId): Collection
    {
        return User::with(['tryoutResults' => function ($q) use ($tryoutId) {
                $q->where('tryout_id', $tryoutId);
            }])
            ->whereHas('tryoutResults', fn($q) => $q->where('tryout_id', $tryoutId))
            ->get()
            ->map(function ($user) {
                $user->score = $user->tryoutResults->first()->score ?? 0;
                return $user;
            })
            ->sortByDesc('score')
            ->values();
    }

    /**
     * Ranking Quiz Harian berdasarkan daily_quiz_id.
     */
    public static function dailyQuiz($dailyQuizId): Collection
    {
        return User::with(['dailyQuizResults' => function ($q) use ($dailyQuizId) {
                $q->where('daily_quiz_id', $dailyQuizId);
            }])
            ->whereHas('dailyQuizResults', fn($q) => $q->where('daily_quiz_id', $dailyQuizId))
            ->get()
            ->map(function ($user) {
                $user->score = $user->dailyQuizResults->first()->score ?? 0;
                return $user;
            })
            ->sortByDesc('score')
            ->values();
    }

    /**
     * Ranking Post-Test berdasarkan post_test_id.
     */
    public static function postTest($postTestId): Collection
    {
        return User::with(['postTestResults' => function ($q) use ($postTestId) {
                $q->where('post_test_id', $postTestId);
            }])
            ->whereHas('postTestResults', fn($q) => $q->where('post_test_id', $postTestId))
            ->get()
            ->map(function ($user) {
                $user->score = $user->postTestResults->first()->score ?? 0;
                return $user;
            })
            ->sortByDesc('score')
            ->values();
    }

    /**
     * Ranking Global dari seluruh aktivitas:
     * - Tryout
     * - Quiz Harian
     * - Post-Test
     */
    public static function global(): Collection
    {
        return User::role('siswa')
            ->withSum('tryoutResults as total_tryout', 'score')
            ->withSum('dailyQuizResults as total_daily', 'score')
            ->withSum('postTestResults as total_post', 'score')
            ->get()
            ->map(function ($user) {
                $user->global_score =
                      ($user->total_tryout ?? 0)
                    + ($user->total_daily ?? 0)
                    + ($user->total_post ?? 0);

                return $user;
            })
            ->sortByDesc('global_score')
            ->values();
    }
}
