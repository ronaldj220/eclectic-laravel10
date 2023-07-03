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
        Schema::table('admin_purchase_order_detail', function (Blueprint $table) {
            $table->float('PPN')->nullable()->after('nominal');
            $table->float('PPH')->nullable()->after('PPN');
            $table->float('PPH_4')->nullable()->after('PPH');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_purchase_order_detail', function (Blueprint $table) {
            $table->dropColumn('PPN');
            $table->dropColumn('PPH');
            $table->dropColumn('PPH_4');
        });
    }
};
