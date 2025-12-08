<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('daily_quiz_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_quiz_id')->constrained('daily_quizzes')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('score')->nullable();
            $table->json('answers')->nullable();
            $table->timestamps();

            $table->unique(['daily_quiz_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_quiz_results');
    }
};
