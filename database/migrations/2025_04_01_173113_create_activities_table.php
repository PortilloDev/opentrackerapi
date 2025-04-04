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
        Schema::create('activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('organization_id')->nullable();
            $table->uuid('activity_type_id');
            $table->string('title', 100);
            $table->dateTime('start_time');
            $table->integer('duration'); // Duración en segundos
            $table->float('distance'); // Distancia en metros
            $table->float('elevation_gain')->nullable(); // Desnivel en metros
            $table->float('avg_speed')->nullable(); // Velocidad media en m/s
            $table->float('max_speed')->nullable(); // Velocidad máxima en m/s
            $table->unsignedTinyInteger('avg_heart_rate')->nullable(); // FC media en lpm
            $table->unsignedTinyInteger('max_heart_rate')->nullable(); // FC máxima en lpm
            $table->unsignedSmallInteger('avg_power')->nullable(); // Potencia media en watts
            $table->unsignedSmallInteger('max_power')->nullable(); // Potencia máxima en watts
            $table->unsignedInteger('calories')->nullable(); // Calorías estimadas
            $table->uuid('device_id')->nullable(); // Dispositivo usado
            $table->text('route_map')->nullable(); // Representación de la ruta
            $table->json('data')->nullable(); // Datos adicionales en JSON
            $table->timestamps();
            
            // Añadir índices para búsquedas y filtros frecuentes
            $table->index('title');
            $table->index('start_time');
            $table->index('distance');
            $table->index('duration');
            $table->index('created_at');
            
            // Definir relaciones con UUID
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();
                  
            $table->foreign('organization_id')
                  ->references('id')
                  ->on('organizations')
                  ->nullOnDelete();
                  
            $table->foreign('activity_type_id')
                  ->references('id')
                  ->on('activity_types')
                  ->restrictOnDelete();
                  
            $table->foreign('device_id')
                  ->references('id')
                  ->on('devices')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};