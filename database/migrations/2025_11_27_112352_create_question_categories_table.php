<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('question_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); // category per course
            $table->foreignId('meeting_id')->nullable()->constrained('meetings')->onDelete('set null'); // optional tie to meeting
            $table->string('name'); // e.g., "Pertemuan 1 - Akar dan Pangkat"
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_categories');
    }
}
