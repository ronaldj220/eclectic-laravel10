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
        Schema::create('master_PO', function (Blueprint $table) {
            $table->id();
            $table->integer('VAT')->nullable();
            $table->integer('PPH')->nullable();
            $table->integer('PPH_4')->nullable();
            $table->integer('PPH_21')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_PO');
    }
};
