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
        Schema::create('karyawan_timesheet_project_detail', function (Blueprint $table) {
            $table->id();
            $table->string('nama_karyawan')->nullable();
            $table->string('curr')->nullable();
            $table->integer('nominal_awal')->nullable();
            $table->integer('hari_awal')->nullable();
            $table->integer('hari')->nullable();

            $table->unsignedBigInteger('fk_timesheet_project');

            $table->foreign('fk_timesheet_project')->references('id')->on('karyawan_reimbursement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan_timesheet_project_detail');
    }
};
