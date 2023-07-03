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
        Schema::table('admin_cash_advance', function (Blueprint $table) {
            $table->enum('status_paid', ['rejected', 'pending', 'paid'])->nullable()->default('rejected')->after('status_approved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_cash_advance', function (Blueprint $table) {
            $table->dropColumn('status_paid');
        });
    }
};
