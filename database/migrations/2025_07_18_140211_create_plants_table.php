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
        Schema::create('plants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('forest_id');
            $table->string('name'); // contoh: Jati, Mahoni
            $table->enum('type', ['kayu_keras', 'kayu_lunak', 'tanaman_endemik']);
            $table->integer('quantity');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('forest_id')->references('id')->on('forests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
