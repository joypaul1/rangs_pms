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
        Schema::create('k_r_a_apporved_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kra_id');
            $table->foreign('kra_id')->references('id')->on('k_r_a_s')->cascadeOnDelete();
            $table->dateTime('date');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('k_r_a_apporved_histories');
    }
};
