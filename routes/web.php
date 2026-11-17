<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipmentRentalController;
use App\Http\Controllers\DiveEquipmentController;

Route::get('/', function () {
    return redirect()->route('rentals.index');
});

Route::resource('rentals', EquipmentRentalController::class);

Route::resource('equipment', DiveEquipmentController::class)
    ->only(['index', 'create', 'store', 'update']);

require __DIR__.'/auth.php';
