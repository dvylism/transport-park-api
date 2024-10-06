<?php

namespace App\Http\Resources;

use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @mixin Truck */
class TruckCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($truck): TruckResource {
                return new TruckResource($truck);
            }),
        ];
    }
}
