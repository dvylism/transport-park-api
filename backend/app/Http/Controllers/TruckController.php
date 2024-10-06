<?php

namespace App\Http\Controllers;

use App\Http\Resources\TruckCollection;
use App\Http\Resources\TruckResource;
use App\Models\Truck;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): TruckCollection
    {
        $trucks = Truck::get();

        return new TruckCollection($trucks);
    }

    /**
     * Display the specified resource.
     */
    public function show(Truck $truck): TruckResource
    {
        $truck->load('serviceOrders');

        return new TruckResource($truck);
    }
}
