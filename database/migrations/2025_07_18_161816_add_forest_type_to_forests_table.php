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
        Schema::table('forests', function (Blueprint $table) {
            $table->enum('forest_type', ['konservasi', 'produksi', 'lindung', 'wisata'])->default('konservasi')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forests', function (Blueprint $table) {
            $table->dropColumn('forest_type');
        });
    }
};
