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
        Schema::create('role_has_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_role');

            $table->foreign('fk_role')->references('id')->on('role');
            $table->unsignedBigInteger('fk_user');

            $table->foreign('fk_user')->references('id')->on('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_has_user_tables');
    }
};
