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
        Schema::table('menyetujui', function (Blueprint $table) {
            $table->string('no_rekening')->nullable()->after('no_telp');
            $table->string('bank')->nullable()->after('no_rekening');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menyetujui', function (Blueprint $table) {
            $table->dropColumn('no_rekening');
            $table->dropColumn('bank');
        });
    }
};
