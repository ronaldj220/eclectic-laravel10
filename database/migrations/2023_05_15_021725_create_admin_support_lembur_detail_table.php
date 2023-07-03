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
        Schema::create('admin_support_lembur_detail', function (Blueprint $table) {
            $table->id();
            $table->string('nama_karyawan')->nullable();
            $table->string('aliases')->nullable();
            $table->string('curr')->nullable();
            $table->integer('nominal_awal')->nullable();
            $table->integer('jam')->nullable();

            $table->unsignedBigInteger('fk_support_lembur');

            $table->foreign('fk_support_lembur')->references('id')->on('admin_reimbursement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_support_lembur_detail');
    }
};
