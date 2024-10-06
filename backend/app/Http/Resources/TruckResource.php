<?php

namespace App\Http\Resources;

use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Truck */
class TruckResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->model,
            'type' => 'truck',
            'plate_number' => $this->plate_number,
            'serviceOrders' => $this->whenLoaded('serviceOrders', function () {
                return ServiceOrderResource::collection($this->whenLoaded('serviceOrders'));
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
