<?php

namespace App\Http\Resources;

use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @mixin ServiceOrder */
class ServiceOrderCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($order): ServiceOrderResource {
                return new ServiceOrderResource($order);
            }),
        ];
    }
}
