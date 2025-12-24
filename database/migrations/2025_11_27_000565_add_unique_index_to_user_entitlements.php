<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_entitlements', function (Blueprint $table) {
            $table->unique(
                ['user_id', 'entitlement_type', 'entitlement_id'],
                'user_entitlements_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('user_entitlements', function (Blueprint $table) {
            $table->dropUnique('user_entitlements_unique');
        });
    }
};
