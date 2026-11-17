<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiveEquipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gear_item_name' => 'required|string|max:255',
            'gear_serial' => 'required|string|max:255|unique:dive_equipment,gear_serial',
            'daily_fee' => 'required|numeric|min:0',
            'status' => 'required|string|max:50',
        ];
    }
}
