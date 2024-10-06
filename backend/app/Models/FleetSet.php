<?php

namespace App\Models;

use App\Enums\FleetSetStatus;
use App\Interfaces\Serviceable;
use App\Traits\ServiceableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class FleetSet extends Model implements Serviceable
{
    use HasFactory;
    use ServiceableTrait;

    protected $fillable = ['truck_id', 'trailer_id', 'first_driver_id', 'second_driver_id', 'status'];

    public function truck(): BelongsTo
    {
        return $this->belongsTo(Truck::class);
    }

    public function trailer(): BelongsTo
    {
        return $this->belongsTo(Trailer::class);
    }

    public function serviceOrders(): MorphMany
    {
        return $this->morphMany(ServiceOrder::class, 'serviceable');
    }

    public function firstDriver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'first_driver_id');
    }

    public function secondDriver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'second_driver_id');
    }

    public function getStatusAttribute(): string
    {
        if ($this->truck?->isUnderService() || $this->trailer?->isUnderService()) {
            return FleetSetStatus::DOWNTIME->value;
        } elseif ((! $this->truck?->isUnderService() && ! $this->trailer?->isUnderService()) || $this->isInService()) {
            return FleetSetStatus::WORKS->value;
        }

        return FleetSetStatus::FREE->value;
    }
}
