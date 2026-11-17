<?php

namespace App\Services;
use App\Models\Diver;
use App\Models\DiveSite;
use App\Models\DiveEquipment;
use App\Models\EquipmentRental;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class EquipmentRentalService
{
    /**
     * Create a rental and its equipment items.
     */
    public function createRental(array $data): EquipmentRental
    {
        return DB::transaction(function () use ($data) {

            // Find diver and dive site
            $diver = Diver::findOrFail($data['diver_id']);
            $site = DiveSite::findOrFail($data['dive_site_id']);

            // Project-defined certification levels
            $certificationLevels = [
                'open water' => 1,
                'advanced open water' => 2,
                'rescue diver' => 3,
            ];

            $diverLevel = $certificationLevels[
                strtolower(trim($diver->certification_level))
            ] ?? 0;

            // Validate certification requirement
            if ($diverLevel < $site->minimum_certification_level) {
                throw ValidationException::withMessages([
                    'dive_site_id' =>
                        'The diver does not meet the minimum certification level for this dive site.'
                ]);
            }

            // Calculate rental days (inclusive of start and end dates)
            $rentalDays = Carbon::parse($data['rental_start'])
                ->diffInDays(Carbon::parse($data['rental_end'])) + 1;

            // Get selected equipment and lock records
            $equipmentIds = collect($data['items'])
                ->pluck('dive_equipment_id')
                ->unique()
                ->sort()
                ->values();

            $equipment = DiveEquipment::whereIn('id', $equipmentIds)
                ->lockForUpdate()
                ->get();

            if ($equipment->count() !== $equipmentIds->count()) {
                throw ValidationException::withMessages([
                    'items' => 'One or more selected equipment items do not exist.'
                ]);
            }

            // Check availability and calculate total
            $totalDailyFee = 0;

            foreach ($equipment as $item) {
                if (strtolower($item->status) !== 'available') {
                    throw ValidationException::withMessages([
                        'items' =>
                            $item->gear_item_name . ' is not available.'
                    ]);
                }

                $totalDailyFee += (float) $item->daily_fee;
            }

            $totalCharge = round($totalDailyFee * $rentalDays, 2);

            // Create rental record
            $rental = EquipmentRental::create([
                'diver_id' => $diver->id,
                'dive_site_id' => $site->id,
                'rental_start' => $data['rental_start'],
                'rental_end' => $data['rental_end'],
                'total_charge' => $totalCharge,
            ]);

            // Save equipment rental items
            foreach ($equipment as $item) {
                $rental->rentalItems()->create([
                    'dive_equipment_id' => $item->id,
                    'daily_fee' => $item->daily_fee,
                ]);

                // Mark equipment as rented
                $item->update([
                    'status' => 'rented',
                ]);
            }

            return $rental;
        });
    }
}
