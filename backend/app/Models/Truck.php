<?php

namespace App\Models;

use App\Interfaces\Maintainable;
use App\Interfaces\Serviceable;
use App\Traits\MaintainableTrait;
use App\Traits\ServiceableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Truck extends Model implements Maintainable, Serviceable
{
    use HasFactory;
    use MaintainableTrait;
    use ServiceableTrait;

    protected $fillable = ['model', 'licence_plate_number'];

    public function fleetSets(): HasMany
    {
        return $this->hasMany(FleetSet::class);
    }

    public function maintenances(): MorphMany
    {
        return $this->morphMany(Maintenance::class, 'maintainable');
    }

    public function serviceOrders(): MorphMany
    {
        return $this->morphMany(ServiceOrder::class, 'serviceable');
    }
}
