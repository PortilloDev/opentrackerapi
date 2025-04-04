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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->string('event');
            $table->string('auditable_type')->nullable();
            $table->string('auditable_id')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->text('url')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->json('tags')->nullable();
            $table->uuid('organization_id')->nullable();
            $table->timestamps();
            
            // Índices para búsquedas frecuentes
            $table->index('event');
            $table->index(['auditable_type', 'auditable_id']);
            $table->index('created_at');
            $table->index('ip_address');
            
            // Relaciones
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->nullOnDelete();
                  
            $table->foreign('organization_id')
                  ->references('id')
                  ->on('organizations')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
}; 