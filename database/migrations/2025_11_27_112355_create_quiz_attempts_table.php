<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizAttemptsTable extends Migration
{
    public function up()
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('submitted_at')->nullable();
            $table->unsignedInteger('duration_seconds')->nullable(); // actual used time
            $table->decimal('score', 8, 2)->nullable();
            $table->boolean('is_submitted')->default(false);
            $table->timestamps();

            $table->unique(['quiz_id','user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('quiz_attempts');
    }
}
