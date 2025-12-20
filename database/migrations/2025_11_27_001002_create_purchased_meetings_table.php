<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedMeetingsTable extends Migration
{
    public function up()
    {
        Schema::create('purchased_meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained('package_purchases')->onDelete('cascade');
            $table->foreignId('meeting_id')->constrained('meetings')->onDelete('cascade');
            $table->unique(['purchase_id','meeting_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchased_meetings');
    }
}
