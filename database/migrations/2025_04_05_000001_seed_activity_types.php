<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Insertar tipos de actividad predefinidos
        DB::table('activity_types')->insert([
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Run',
                'icon' => 'fa-running',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Ride',
                'icon' => 'fa-bicycle',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Swim',
                'icon' => 'fa-swimmer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Hike',
                'icon' => 'fa-hiking',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Walk',
                'icon' => 'fa-walking',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Yoga',
                'icon' => 'fa-om',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Strength',
                'icon' => 'fa-dumbbell',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Ski',
                'icon' => 'fa-skiing',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('activity_types')->whereIn('name', ['Run', 'Ride', 'Swim', 'Hike', 'Walk', 'Yoga', 'Strength', 'Ski'])->delete();
    }
}; 