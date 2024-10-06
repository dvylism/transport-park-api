<?php

namespace App\Http\Resources;

use App\Models\FleetSet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @mixin FleetSet */
class FleetSetCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($fleet): FleetSetResource {
                return new FleetSetResource($fleet);
            }),
        ];
    }
}
