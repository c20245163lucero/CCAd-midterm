<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiveResortSeeder extends Seeder
{
    public function run(): void
    {
        // SAMPLE DIVERS
        DB::table('divers')->insert([
            [
                'diver_name' => 'Maria Santos',
                'certification_level' => 'Open Water',
                'cert_number' => 'OW-2026-001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'diver_name' => 'Juan Dela Cruz',
                'certification_level' => 'Advanced Open Water',
                'cert_number' => 'AOW-2026-002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'diver_name' => 'Ana Reyes',
                'certification_level' => 'Rescue Diver',
                'cert_number' => 'RD-2026-003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // SAMPLE DIVE SITES
        DB::table('dive_sites')->insert([
            [
                'site_name' => 'Coral Garden',
                'minimum_certification_level' => 1,
                'required_max_depth' => 18.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'site_name' => 'Turtle Point',
                'minimum_certification_level' => 2,
                'required_max_depth' => 30.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'site_name' => 'Deep Blue Reef',
                'minimum_certification_level' => 3,
                'required_max_depth' => 40.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // SAMPLE DIVE EQUIPMENT
        DB::table('dive_equipment')->insert([
            [
                'gear_item_name' => 'Scuba Diving Mask',
                'gear_serial' => 'MASK-001',
                'daily_fee' => 150.00,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gear_item_name' => 'Oxygen Tank',
                'gear_serial' => 'TANK-001',
                'daily_fee' => 500.00,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gear_item_name' => 'Diving Fins',
                'gear_serial' => 'FINS-001',
                'daily_fee' => 200.00,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gear_item_name' => 'Wetsuit',
                'gear_serial' => 'SUIT-001',
                'daily_fee' => 300.00,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gear_item_name' => 'Regulator',
                'gear_serial' => 'REG-001',
                'daily_fee' => 350.00,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
