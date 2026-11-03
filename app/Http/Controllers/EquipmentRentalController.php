<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EquipmentRental;
use App\Models\Diver;
use App\Models\DiveSite;
use App\Models\DiveEquipment;

class EquipmentRentalController extends Controller
{
    // Display all rentals
    public function index()
    {
        $rentals = EquipmentRental::with([
            'diver',
            'diveSite',
            'rentalItems.equipment'
        ])->latest()->paginate(10);

        return view('rentals.index', compact('rentals'));
    }

    // Show create rental form
    public function create()
    {
        $divers = Diver::all();
        $diveSites = DiveSite::all();
        $equipment = DiveEquipment::all();

        return view('rentals.create', compact(
            'divers',
            'diveSites',
            'equipment'
        ));
    }

    // Save rental
    public function store(Request $request)
    {
        $validated = $request->validate([
            'diver_id' => 'required|exists:divers,id',
            'dive_site_id' => 'required|exists:dive_sites,id',
            'rental_start' => 'required|date',
            'rental_end' => 'required|date|after_or_equal:rental_start',
        ]);

        EquipmentRental::create($validated);

        return redirect()
            ->route('rentals.index')
            ->with('success', 'Rental added successfully!');
    }

    // Display one rental
    public function show(EquipmentRental $rental)
    {
        $rental->load([
            'diver',
            'diveSite',
            'rentalItems.equipment'
        ]);

        return view('rentals.show', compact('rental'));
    }

    // Show edit form
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

    // Update rental
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

    // Delete rental
    public function destroy(EquipmentRental $rental)
    {
        $rental->delete();

        return redirect()
            ->route('rentals.index')
            ->with('success', 'Rental deleted successfully!');
    }
}
