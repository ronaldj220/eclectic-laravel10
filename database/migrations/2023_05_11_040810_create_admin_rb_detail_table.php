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
        Schema::create('admin_rb_detail', function (Blueprint $table) {
            $table->id();
            $table->string('deskripsi')->nullable();
            $table->string('bukti_reim')->nullable();
            $table->string('no_bukti')->nullable();
            $table->string('curr')->nullable();
            $table->integer('nominal')->nullable();
            $table->date('tanggal_1')->nullable();
            $table->date('tanggal_2')->nullable();
            $table->unsignedBigInteger('fk_rb');

            $table->foreign('fk_rb')->references('id')->on('admin_reimbursement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_rb_detail');
    }
};
