<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EquipmentRental extends Model
{
    use HasFactory;

    protected $fillable = [
        'diver_id',
        'dive_site_id',
        'rental_start',
        'rental_end',
        'total_charge',
    ];

    protected function casts(): array
    {
        return [
            'rental_start' => 'date',
            'rental_end' => 'date',
            'total_charge' => 'decimal:2',
        ];
    }

    public function diver(): BelongsTo
    {
        return $this->belongsTo(Diver::class, 'diver_id');
    }

    public function diveSite(): BelongsTo
    {
        return $this->belongsTo(DiveSite::class, 'dive_site_id');
    }

    public function rentalItems(): HasMany
    {
        return $this->hasMany(
            EquipmentRentalItem::class,
            'equipment_rental_id'
        );
    }

    public function equipment(): BelongsToMany
    {
        return $this->belongsToMany(
            DiveEquipment::class,
            'equipment_rental_items',
            'equipment_rental_id',
            'dive_equipment_id'
        )->withPivot('daily_fee', 'return_condition')
         ->withTimestamps();
    }
}
