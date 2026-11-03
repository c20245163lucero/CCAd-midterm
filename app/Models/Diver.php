<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Diver extends Model
{
    use HasFactory;

    protected $fillable = [
        'diver_name',
        'certification_level',
        'cert_number',
    ];

    public function rentals(): HasMany
    {
        return $this->hasMany(EquipmentRental::class, 'diver_id');
    }
}
