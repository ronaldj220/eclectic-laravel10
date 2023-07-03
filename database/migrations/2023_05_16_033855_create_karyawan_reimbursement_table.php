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
        Schema::create('karyawan_reimbursement', function (Blueprint $table) {
            $table->id();
            $table->string('no_doku')->nullable();
            $table->date('tgl_diajukan')->nullable();
            $table->string('judul_doku')->nullable();
            $table->string('pemohon')->nullable();
            $table->string('accounting')->nullable();
            $table->string('kasir')->nullable();
            $table->string('menyetujui')->nullable();
            $table->enum('status_approved', ['rejected', 'pending', 'approved'])->default('rejected');
            $table->enum('status_paid', ['rejected', 'pending', 'paid'])->default('rejected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan_reimbursement');
    }
};
