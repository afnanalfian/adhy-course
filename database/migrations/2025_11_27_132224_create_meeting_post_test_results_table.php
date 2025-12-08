<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('meeting_post_test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_test_id')->constrained('meeting_post_tests')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('score')->nullable();
            $table->json('answers')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();

            $table->unique(['post_test_id', 'user_id']); // satu kali attempt saja
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meeting_post_test_results');
    }
};
