<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EquipmentRentalItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_rental_id',
        'dive_equipment_id',
        'daily_fee',
        'return_condition',
    ];

    protected function casts(): array
    {
        return [
            'daily_fee' => 'decimal:2',
        ];
    }

    public function rental(): BelongsTo
    {
        return $this->belongsTo(
            EquipmentRental::class,
            'equipment_rental_id'
        );
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(
            DiveEquipment::class,
            'dive_equipment_id'
        );
    }
}
