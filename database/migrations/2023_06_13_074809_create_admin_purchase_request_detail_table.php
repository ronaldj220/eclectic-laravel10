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
        Schema::create('admin_purchase_request_detail', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->date('tgl_1')->nullable();
            $table->date('tgl_2')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('satuan')->nullable();
            $table->date('tgl_pakai')->nullable();
            $table->string('project')->nullable();
            $table->unsignedBigInteger('fk_pr');

            $table->foreign('fk_pr')->references('id')->on('admin_purchase_request');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_purchase_request_detail');
    }
};
