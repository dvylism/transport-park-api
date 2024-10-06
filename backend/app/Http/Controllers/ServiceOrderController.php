<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceOrderCollection;
use App\Http\Resources\ServiceOrderResource;
use App\Models\ServiceOrder;

class ServiceOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ServiceOrderCollection
    {
        $serviceOrders = ServiceOrder::with(['serviceable'])->get();

        return new ServiceOrderCollection($serviceOrders);
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceOrder $serviceOrder): ServiceOrderResource
    {
        $serviceOrder->load(['serviceable']);

        return new ServiceOrderResource($serviceOrder);
    }
}
