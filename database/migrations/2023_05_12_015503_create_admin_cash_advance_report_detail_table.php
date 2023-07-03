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
        Schema::create('admin_cash_advance_report_detail', function (Blueprint $table) {
            $table->id();
            $table->string('deskripsi')->nullable();
            $table->string('bukti_ca')->nullable();
            $table->string('no_bukti')->nullable();
            $table->string('curr')->nullable();
            $table->integer('nominal')->nullable();
            $table->date('tanggal_1')->nullable();
            $table->date('tanggal_2')->nullable();
            $table->unsignedBigInteger('fk_ca');

            $table->foreign('fk_ca')->references('id')->on('admin_cash_advance_report');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_cash_advance_report_detail');
    }
};
