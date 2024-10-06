<?php

namespace App\Http\Controllers;

use App\Http\Resources\TrailerCollection;
use App\Http\Resources\TrailerResource;
use App\Models\Trailer;

class TrailerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): TrailerCollection
    {
        $trailers = Trailer::get();

        return new TrailerCollection($trailers);
    }

    /**
     * Display the specified resource.
     */
    public function show(Trailer $trailer): TrailerResource
    {
        $trailer->load(['serviceOrders']);

        return new TrailerResource($trailer);
    }
}
