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
        Schema::create('admin_purchase_order', function (Blueprint $table) {
            $table->id();
            $table->string('no_doku')->nullable();
            $table->date('tgl_purchasing')->nullable();
            $table->string('tipe_pr')->nullable();
            $table->string('supplier')->nullable();
            $table->string('pemohon')->nullable();
            $table->string('accounting')->nullable();
            $table->string('kasir')->nullable();
            $table->string('menyetujui')->nullable();
            $table->enum('status_approved', ['rejected', 'pending', 'approved'])->nullable()->default('rejected');
            $table->enum('status_paid', ['rejected', 'pending', 'paid'])->nullable()->default('rejected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_purchase_order');
    }
};
