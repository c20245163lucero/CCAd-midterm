<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\DiveEquipment;

class UpdateDiveEquipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $equipmentId = $this->route('equipment');

        return [
            'gear_item_name' => 'required|string|max:255',

            'gear_serial' => [
                'required',
                'string',
                'max:255',
                Rule::unique((new DiveEquipment)->getTable(), 'gear_serial')
                    ->ignore($equipmentId),
            ],

            'daily_fee' => 'required|numeric|min:0',
            'status' => 'required|string|max:50',
        ];
    }
}
