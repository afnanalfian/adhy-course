<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_deletion_logs', function (Blueprint $table) {
            $table->id();

            // user yang menghapus akun
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // alasan yang dipilih dari daftar dropdown
            $table->string('reason_option')->nullable();

            // alasan custom jika memilih "Lainnya"
            $table->text('reason_custom')->nullable();

            // waktu dinonaktifkan
            $table->timestamp('deactivated_at')->nullable();

            // waktu benar-benar terhapus (setelah 10 hari)
            $table->timestamp('deleted_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_deletion_logs');
    }
};
