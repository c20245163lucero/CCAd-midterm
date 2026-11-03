<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipmentRentalController;

Route::get('/', function () {
    return redirect()->route('rentals.index');
});

Route::resource('rentals', EquipmentRentalController::class);
require __DIR__.'/auth.php';
