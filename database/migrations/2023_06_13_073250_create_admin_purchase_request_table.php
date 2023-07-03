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
        Schema::create('admin_purchase_request', function (Blueprint $table) {
            $table->id();
            $table->string('no_doku')->nullable();
            $table->date('tgl_diajukan')->nullable();
            $table->string('pemohon')->nullable();
            $table->string('menyetujui')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_purchase_request');
    }
};
