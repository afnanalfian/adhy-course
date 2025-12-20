<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('meeting_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meeting_id')->constrained()->cascadeOnDelete();
            $table->string('bunny_video_id')->unique();
            $table->string('library_id');
            $table->string('title');
            $table->string('thumbnail_url')->nullable();
            $table->unsignedBigInteger('duration')->nullable(); // seconds
            $table->enum('status', [
                'uploading',
                'processing',
                'ready',
                'failed',
            ])->default('uploading');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meeting_videos');
    }
};
