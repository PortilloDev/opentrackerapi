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
        Schema::create('organizations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100);
            $table->uuid('organization_type_id');
            $table->uuid('owner_user_id')->nullable();
            $table->timestamps();
            
            // Añadir índice para búsquedas por nombre
            $table->index('name');
            
            // Definir relaciones con UUID
            $table->foreign('organization_type_id')
                  ->references('id')
                  ->on('organization_types')
                  ->cascadeOnDelete();
                  
            $table->foreign('owner_user_id')
                  ->references('id')
                  ->on('users')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
