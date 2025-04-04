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
        Schema::create('devices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('name', 100);
            $table->string('type', 50);
            $table->string('model', 100);
            $table->string('identifier', 100)->nullable()->unique();
            $table->timestamps();
            
            // Añadir índices para búsquedas frecuentes
            $table->index('name');
            $table->index('type');
            $table->index('model');
            
            // Definir relación con UUID
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};