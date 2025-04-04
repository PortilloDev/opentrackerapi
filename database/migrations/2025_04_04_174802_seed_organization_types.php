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
        DB::table('organization_types')->insert([
            ['id' => Str::uuid()->toString(), 'name' => 'Club', 'description' => 'Sports or recreational club', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid()->toString(), 'name' => 'Team', 'description' => 'Sports team or group', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid()->toString(), 'name' => 'Company', 'description' => 'Business organization', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid()->toString(), 'name' => 'Association', 'description' => 'Non-profit organization', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid()->toString(), 'name' => 'School', 'description' => 'Educational institution', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('organization_types')->whereIn('name', ['Club', 'Team', 'Company', 'Association', 'School'])->delete();
    }
};
