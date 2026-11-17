<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentRentalRequest;
use App\Models\EquipmentRental;
use App\Models\Diver;
use App\Models\DiveSite;
use App\Models\DiveEquipment;
use App\Services\EquipmentRentalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipmentRentalController extends Controller
{
    protected EquipmentRentalService $rentalService;

    public function __construct(EquipmentRentalService $rentalService)
    {
        $this->rentalService = $rentalService;
    }

    public function index()
    {
        $rentals = EquipmentRental::with([
            'diver',
            'diveSite',
            'rentalItems.equipment'
        ])->latest()->paginate(10);

        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $divers = Diver::all();
        $diveSites = DiveSite::all();

        $equipment = DiveEquipment::where('status', 'available')->get();

        return view('rentals.create', compact(
            'divers',
            'diveSites',
            'equipment'
        ));
    }

    public function store(StoreEquipmentRentalRequest $request)
    {
        $this->rentalService->createRental($request->validated());

        return redirect()
            ->route('rentals.index')
            ->with('success', 'Rental created successfully!');
    }

    public function show(EquipmentRental $rental)
    {
        $rental->load([
            'diver',
            'diveSite',
            'rentalItems.equipment'
        ]);

        return view('rentals.show', compact('rental'));
    }

    public function edit(EquipmentRental $rental)
    {
        $divers = Diver::all();
        $diveSites = DiveSite::all();
        $equipment = DiveEquipment::all();

        return view('rentals.edit', compact(
            'rental',
            'divers',
            'diveSites',
            'equipment'
        ));
    }

    public function update(Request $request, EquipmentRental $rental)
    {
        $validated = $request->validate([
            'diver_id' => 'required|exists:divers,id',
            'dive_site_id' => 'required|exists:dive_sites,id',
            'rental_start' => 'required|date',
            'rental_end' => 'required|date|after_or_equal:rental_start',
        ]);

        $rental->update($validated);

        return redirect()
            ->route('rentals.index')
            ->with('success', 'Rental updated successfully!');
    }

    public function destroy(EquipmentRental $rental)
    {
        DB::transaction(function () use ($rental) {
            $rental->load('rentalItems.equipment');

            // Make the equipment available again.
            foreach ($rental->rentalItems as $rentalItem) {
                if ($rentalItem->equipment) {
                    $rentalItem->equipment->update([
                        'status' => 'available',
                    ]);
                }
            }

            // Rental items are removed through the database cascade.
            $rental->delete();
        });

        return redirect()
            ->route('rentals.index')
            ->with('success', 'Rental deleted successfully!');
    }
}
