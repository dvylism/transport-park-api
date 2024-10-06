<?php

namespace App\Http\Resources;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @mixin Driver */
class DriverCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($driver): DriverResource {
                return new DriverResource($driver);
            }),
        ];
    }
}
