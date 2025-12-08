<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_category_id')->constrained('question_categories')->onDelete('cascade');
            $table->text('question'); // supports HTML/math
            // multiple choice options
            $table->text('option_a');
            $table->text('option_b');
            $table->text('option_c')->nullable();
            $table->text('option_d')->nullable();
            $table->enum('correct_option', ['a','b','c','d']);
            $table->longText('explanation')->nullable(); // pembahasan
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null'); // tentor/admin
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
