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
        Schema::create('server_connections', function (Blueprint $table) {
            $table->id();
            $table->string('DB_CONNECTION');
            $table->string('DB_HOST');
            $table->string('DB_PORT');
            $table->string('DB_DATABASE')->comment('xe');
            $table->string('DB_USERNAME');
            $table->string('DB_PASSWORD');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_connections');
    }
};
