<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DiveEquipment extends Model
{
    use HasFactory;

    protected $table = 'dive_equipment';

    protected $fillable = [
        'gear_item_name',
        'gear_serial',
        'daily_fee',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'daily_fee' => 'decimal:2',
        ];
    }

    public function rentalItems(): HasMany
    {
        return $this->hasMany(
            EquipmentRentalItem::class,
            'dive_equipment_id'
        );
    }

    public function rentals(): BelongsToMany
    {
        return $this->belongsToMany(
            EquipmentRental::class,
            'equipment_rental_items',
            'dive_equipment_id',
            'equipment_rental_id'
        )->withPivot('daily_fee', 'return_condition')
         ->withTimestamps();
    }
}
