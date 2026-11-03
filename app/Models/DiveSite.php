<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiveSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'minimum_certification_level',
        'required_max_depth',
    ];

    protected function casts(): array
    {
        return [
            'minimum_certification_level' => 'integer',
            'required_max_depth' => 'decimal:2',
        ];
    }

    public function rentals(): HasMany
    {
        return $this->hasMany(EquipmentRental::class, 'dive_site_id');
    }
}
