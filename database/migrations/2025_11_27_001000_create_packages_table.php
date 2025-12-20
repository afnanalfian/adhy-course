<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('min_meetings')->default(1);
            $table->unsignedInteger('max_meetings')->nullable(); // null => unlimited / full
            $table->decimal('price_per_meeting', 12, 2)->nullable();
            $table->decimal('flat_price', 12, 2)->nullable();
            $table->boolean('include_daily_quiz')->default(false);
            $table->boolean('include_tryout')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
