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
        Schema::create('admin_purchase_order_detail', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('nominal')->nullable();
            $table->integer('PPH_21')->nullable();
            $table->integer('diskon')->nullable();
            $table->string('ctm_1')->nullable();
            $table->integer('ctm_2')->nullable();

            $table->unsignedBigInteger('fk_po');

            $table->foreign('fk_po')->references('id')->on('admin_purchase_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_purchase_order_detail');
    }
};
