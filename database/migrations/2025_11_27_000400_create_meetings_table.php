<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->nullable()->unique();
            $table->text('description')->nullable();
            $table->longText('summary')->nullable(); // ringkasan materi (HTML)
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->string('zoom_link')->nullable();
            $table->string('recording_url')->nullable(); // Bunny playback URL
            $table->enum('status', ['upcoming','live','done','cancelled'])->default('upcoming');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null'); // tentor/admin yang buat
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
