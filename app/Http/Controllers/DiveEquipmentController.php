<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiveEquipmentRequest;
use App\Http\Requests\UpdateDiveEquipmentRequest;
use App\Services\DiveEquipmentService;

class DiveEquipmentController extends Controller
{
    protected DiveEquipmentService $equipmentService;

    // DEPENDENCY INJECTION
    public function __construct(
        DiveEquipmentService $equipmentService
    ) {
        $this->equipmentService = $equipmentService;
    }

    // READ ALL
    public function index()
    {
        $equipment = $this->equipmentService->getAll();

        return view('equipment.index', compact('equipment'));
    }

    // CREATE FORM
    public function create()
    {
        return view('equipment.create');
    }

    // STORE
    public function store(StoreDiveEquipmentRequest $request)
    {
        $this->equipmentService->create(
            $request->validated()
        );

        return redirect()
            ->route('equipment.index')
            ->with('success', 'Equipment added successfully!');
    }

    // READ ONE
    public function show($id)
    {
        $equipment = $this->equipmentService->getById($id);

        return view('equipment.show', compact('equipment'));
    }

    // EDIT FORM
    public function edit($id)
    {
        $equipment = $this->equipmentService->getById($id);

        return view('equipment.edit', compact('equipment'));
    }

    // UPDATE
    public function update(
        UpdateDiveEquipmentRequest $request,
        $id
    ) {
        $this->equipmentService->update(
            $id,
            $request->validated()
        );

        return redirect()
            ->route('equipment.index')
            ->with('success', 'Equipment updated successfully!');
    }

    // DELETE
    public function destroy($id)
    {
        $this->equipmentService->delete($id);

        return redirect()
            ->route('equipment.index')
            ->with('success', 'Equipment deleted successfully!');
    }
}
