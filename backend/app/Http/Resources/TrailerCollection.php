<?php

namespace App\Http\Resources;

use App\Models\Trailer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @mixin Trailer */
class TrailerCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($trailer): TrailerResource {
                return new TrailerResource($trailer);
            }),
        ];
    }
}
