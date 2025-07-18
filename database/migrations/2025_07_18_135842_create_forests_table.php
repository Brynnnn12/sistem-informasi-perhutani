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
        Schema::create('forests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('location'); // bisa string GPS atau alamat
            $table->float('area_size')->comment('Luas dalam hektar');
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'protected', 'damaged'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forests');
    }
};
