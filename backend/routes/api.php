<?php

use App\Http\Controllers\FleetSetController;
use App\Http\Controllers\ServiceOrderController;
use App\Http\Controllers\TrailerController;
use App\Http\Controllers\TruckController;
use Illuminate\Support\Facades\Route;

Route::get('/fleet-sets', [FleetSetController::class, 'index'])->name(name: 'fleet-sets.index');
Route::get('/fleet-sets/{fleetSet}', [FleetSetController::class, 'show'])->name('fleet-sets.show');

Route::get('/trucks', [TruckController::class, 'index'])->name('trucks.index');
Route::get('/trucks/{truck}', [TruckController::class, 'show'])->name('trucks.show');

Route::get('/trailers', [TrailerController::class, 'index'])->name('trailers.index');
Route::get('/trailers/{trailer}', [TrailerController::class, 'show'])->name('trailers.show');

Route::get('/service-orders', [ServiceOrderController::class, 'index'])->name('service-orders.index');
Route::get('/service-orders/{serviceOrder}', [ServiceOrderController::class, 'show'])->name('service-orders.show');
