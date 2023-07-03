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
            $table->string('bukti_support_lembur')->nullable()->after('bukti_support_ticket');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_reimbursement', function (Blueprint $table) {
            $table->dropColumn('bukti_support_lembur');
        });
    }
};
