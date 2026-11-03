<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiveResortSeeder extends Seeder
{
    public function run(): void
    {
        $diverId = DB::table('divers')->insertGetId([
            'first_name' => 'John',
            'last_name' => 'Diver',
            'email' => 'john@example.com',
            'phone' => '09123456789',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $siteId = DB::table('dive_sites')->insertGetId([
            'site_name' => 'Coral Garden',
            'location' => 'Negros Occidental',
            'description' => 'Sample diving location.',
            'price' => 1500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $equipmentId = DB::table('dive_equipment')->insertGetId([
            'equipment_name' => 'Diving Mask',
            'category' => 'Safety Gear',
            'quantity' => 10,
            'rental_price' => 150.00,
            'status' => 'available',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $rentalId = DB::table('equipment_rentals')->insertGetId([
            'diver_id' => $diverId,
            'dive_site_id' => $siteId,
            'rental_date' => now()->toDateString(),
            'return_date' => null,
            'total_amount' => 150.00,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('equipment_rental_items')->insert([
            'equipment_rental_id' => $rentalId,
            'dive_equipment_id' => $equipmentId,
            'quantity' => 1,
            'price' => 150.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
