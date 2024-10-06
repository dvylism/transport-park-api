<?php

namespace App\Http\Controllers;

use App\Http\Resources\FleetSetCollection;
use App\Http\Resources\FleetSetResource;
use App\Models\FleetSet;

class FleetSetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): FleetSetCollection
    {
        $fleetSets = FleetSet::with(['truck', 'trailer', 'firstDriver', 'secondDriver'])->get();

        return new FleetSetCollection($fleetSets);
    }

    /**
     * Display the specified resource.
     */
    public function show(FleetSet $fleetSet): FleetSetResource
    {
        $fleetSet->load(['truck', 'trailer', 'firstDriver', 'secondDriver', 'serviceOrders']);

        return new FleetSetResource($fleetSet);
    }
}
