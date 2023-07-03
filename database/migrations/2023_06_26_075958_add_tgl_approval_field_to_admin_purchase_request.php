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
        Schema::table('admin_purchase_request', function (Blueprint $table) {
            $table->date('tgl_approval')->nullable()->after('status_approved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_purchase_request', function (Blueprint $table) {
            $table->dropColumn('tgl_approval');
        });
    }
};
