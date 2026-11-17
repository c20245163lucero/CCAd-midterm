<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipmentRentalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'diver_id' => [
                'required',
                'integer',
                'exists:divers,id',
            ],

            'dive_site_id' => [
                'required',
                'integer',
                'exists:dive_sites,id',
            ],

            'rental_start' => [
                'required',
                'date',
            ],

            'rental_end' => [
                'required',
                'date',
                'after_or_equal:rental_start',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.dive_equipment_id' => [
                'required',
                'integer',
                'distinct',
                'exists:dive_equipment,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'diver_id.required' =>
                'Please select a diver.',

            'diver_id.exists' =>
                'The selected diver does not exist.',

            'dive_site_id.required' =>
                'Please select a dive site.',

            'dive_site_id.exists' =>
                'The selected dive site does not exist.',

            'rental_start.required' =>
                'Please select a rental start date.',

            'rental_end.required' =>
                'Please select a rental end date.',

            'rental_end.after_or_equal' =>
                'The rental end date must be on or after the start date.',

            'items.required' =>
                'Please select at least one equipment item.',

            'items.min' =>
                'A rental must contain at least one equipment item.',

            'items.*.dive_equipment_id.required' =>
                'Please select equipment for every item.',

            'items.*.dive_equipment_id.exists' =>
                'The selected equipment does not exist.',

            'items.*.dive_equipment_id.distinct' =>
                'The same equipment cannot be selected more than once.',
        ];
    }
}
