<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('package_purchases', function (Blueprint $table) {
            $table->enum('purchase_path', ['umum', 'beasiswa'])->default('umum')->after('total_amount');
            $table->string('nisn')->nullable()->after('purchase_path');
            $table->string('nik')->nullable()->after('nisn');
            $table->boolean('scholarship_verified')->default(false)->after('nik');
            $table->integer('discount_percent')->default(0)->after('scholarship_verified');
            $table->integer('discount_amount')->default(0)->after('discount_percent');
            $table->decimal('final_price',12,2)->nullable()->after('discount_amount');
        });
    }

    public function down(): void
    {
        Schema::table('package_purchases', function (Blueprint $table) {
            $table->dropColumn([
                'purchase_path',
                'nisn',
                'nik',
                'scholarship_verified',
                'discount_percent',
                'discount_amount',
                'final_price'
            ]);
        });
    }
};
