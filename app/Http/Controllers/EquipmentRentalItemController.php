<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentRentalItem extends Model
{
    use HasFactory;

    protected $table = 'equipment_rental_items';

    protected $fillable = [
        'equipment_rental_id',
        'dive_equipment_id',
        'daily_fee',
        'return_condition',
    ];

    protected $casts = [
        'daily_fee' => 'decimal:2',
    ];

    // Relationship to Equipment Rental
    public function rental()
    {
        return $this->belongsTo(
            EquipmentRental::class,
            'equipment_rental_id'
        );
    }

    // Relationship to Dive Equipment
    public function equipment()
    {
        return $this->belongsTo(
            DiveEquipment::class,
            'dive_equipment_id'
        );
    }
}
