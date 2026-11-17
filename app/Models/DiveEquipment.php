<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiveEquipment extends Model
{
    protected $fillable = [
        'gear_item_name',
        'gear_serial',
        'daily_fee',
        'status',
    ];

    protected $casts = [
        'daily_fee' => 'decimal:2',
    ];
}
