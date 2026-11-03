<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEquipmentRentalRequest extends FormRequest
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
                'nullable',
                'integer',
                'exists:dive_sites,id',
            ],

            'rental_date' => [
                'required',
                'date',
            ],

            'return_date' => [
                'nullable',
                'date',
                'after_or_equal:rental_date',
            ],

            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'active',
                    'completed',
                    'cancelled',
                ]),
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

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
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

            'dive_site_id.exists' =>
                'The selected dive site does not exist.',

            'rental_date.required' =>
                'Please select a rental date.',

            'return_date.after_or_equal' =>
                'The return date must be on or after the rental date.',

            'status.required' =>
                'Please select a rental status.',

            'status.in' =>
                'The selected rental status is invalid.',

            'items.required' =>
                'Please add at least one equipment item.',

            'items.min' =>
                'A rental must contain at least one equipment item.',

            'items.*.dive_equipment_id.required' =>
                'Please select equipment for every item.',

            'items.*.dive_equipment_id.exists' =>
                'The selected equipment does not exist.',

            'items.*.dive_equipment_id.distinct' =>
                'Do not select the same equipment type more than once.',

            'items.*.quantity.required' =>
                'Please enter the equipment quantity.',

            'items.*.quantity.integer' =>
                'The equipment quantity must be a whole number.',

            'items.*.quantity.min' =>
                'The equipment quantity must be at least one.',
        ];
    }
}
