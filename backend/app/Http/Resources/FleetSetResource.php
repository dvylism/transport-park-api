<?php

namespace App\Http\Resources;

use App\Models\FleetSet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin FleetSet */
class FleetSetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'truck' => new TruckResource($this->whenLoaded('truck')),
            'trailer' => new TrailerResource($this->whenLoaded('trailer')),
            'drivers' => array_filter([
                new DriverResource($this->whenLoaded('firstDriver')),
                new DriverResource($this->whenLoaded('secondDriver')),
            ]),
            'serviceOrders' => $this->whenLoaded('serviceOrders', function () {
                return ServiceOrderResource::collection($this->whenLoaded('serviceOrders'));
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
