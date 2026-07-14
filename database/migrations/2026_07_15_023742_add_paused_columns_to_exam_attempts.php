<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('exam_attempts', function (Blueprint $table) {
            $table->timestamp('paused_at')->nullable()->after('submitted_at');
            $table->unsignedInteger('total_paused_seconds')->default(0)->after('paused_at');
        });
    }

    public function down()
    {
        Schema::table('exam_attempts', function (Blueprint $table) {
            $table->dropColumn(['paused_at', 'total_paused_seconds']);
        });
    }
};