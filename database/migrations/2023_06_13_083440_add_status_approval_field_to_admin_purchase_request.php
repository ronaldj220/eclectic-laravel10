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
            $table->enum('status_approved', ['rejected', 'pending', 'approved'])->nullable()->default('rejected')->after('status_paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_purchase_request', function (Blueprint $table) {
            $table->dropColumn('status_approved');
        });
    }
};
