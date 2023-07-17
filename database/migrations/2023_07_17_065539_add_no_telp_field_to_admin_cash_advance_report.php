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
        Schema::table('admin_cash_advance_report', function (Blueprint $table) {
            $table->string('no_telp')->nullable()->after('menyetujui');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_cash_advance_report', function (Blueprint $table) {
            $table->dropColumn('no_telp');
        });
    }
};
