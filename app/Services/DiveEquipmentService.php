<?php

namespace App\Services;
use App\Models\DiveEquipment;
use Illuminate\Support\Facades\DB;

class DiveEquipmentService
{
    // CREATE
    public function create(array $data): DiveEquipment
    {
        return DB::transaction(function () use ($data) {
            return DiveEquipment::create($data);
        });
    }

    // READ ALL
    public function getAll()
    {
        return DiveEquipment::all();
    }

    // READ ONE
    public function getById(int $id): DiveEquipment
    {
        return DiveEquipment::findOrFail($id);
    }

    // UPDATE
    public function update(int $id, array $data): DiveEquipment
    {
        return DB::transaction(function () use ($id, $data) {

            $equipment = $this->getById($id);

            $equipment->update($data);

            return $equipment->refresh();
        });
    }

    // DELETE
    public function delete(int $id): bool
    {
        return DB::transaction(function () use ($id) {

            $equipment = $this->getById($id);

            return (bool) $equipment->delete();
        });
    }
}
