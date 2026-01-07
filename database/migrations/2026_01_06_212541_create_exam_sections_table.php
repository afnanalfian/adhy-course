<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exam_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('code', 20); // TIU, TWK, TKP, TPS
            $table->string('name');
            $table->unsignedInteger('order')->default(1);

            $table->foreignId('scoring_profile_id')
                ->constrained('scoring_profiles');

            $table->json('metadata')->nullable(); // max_score, year, dll
            $table->timestamps();

            $table->unique(['exam_id', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_sections');
    }
};
