<?php

namespace App\Http\Resources;

use App\Models\FleetSet;
use App\Models\ServiceOrder;
use App\Models\Trailer;
use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ServiceOrder */
class ServiceOrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'items' => $this->whenLoaded('serviceable', function () {
                $items = collect();

                switch ($this->serviceable_type) {
                    case FleetSet::class:
                        $fleetSet = $this->serviceable;

                        $items->push(new TruckResource($fleetSet->truck));
                        $items->push(new TrailerResource($fleetSet->trailer));
                        break;

                    case Truck::class:
                        $items->push(new TruckResource($this->serviceable));
                        break;

                    case Trailer::class:
                        $items->push(new TrailerResource($this->serviceable));
                        break;

                    default:
                        return $items;
                }

                return $items;
            }),
            'status' => $this->status,
            'serviceable_type' => class_basename($this->serviceable_type),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
