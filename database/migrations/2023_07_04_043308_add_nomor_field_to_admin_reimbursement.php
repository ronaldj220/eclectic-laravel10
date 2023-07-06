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
        Schema::table('admin_reimbursement', function (Blueprint $table) {
            $table->string('no_telp_direksi')->nullable()->after('no_referensi');
            $table->string('no_telp_admin')->nullable()->after('no_telp_direksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_reimbursement', function (Blueprint $table) {
            $table->dropColumn('no_telp_direksi');
            $table->dropColumn('no_telp_admin');
        });
    }
};
