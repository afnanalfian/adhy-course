<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('exam_answers', function (Blueprint $table) {
            $table->decimal('raw_score', 8, 2)
                ->nullable()
                ->after('is_correct');

            $table->json('meta')
                ->nullable()
                ->after('raw_score');
        });
    }

    public function down(): void
    {
        Schema::table('exam_answers', function (Blueprint $table) {
            $table->dropColumn(['raw_score', 'meta']);
        });
    }
};
