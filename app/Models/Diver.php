<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diver extends Model
{
    protected $fillable = [
        'diver_name',
        'certification_level',
        'cert_number',
    ];
}
