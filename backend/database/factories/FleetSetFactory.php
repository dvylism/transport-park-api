<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\FleetSet;
use App\Models\Trailer;
use App\Models\Truck;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FleetSet>
 */
class FleetSetFactory extends Factory
{
    protected $model = FleetSet::class;

    public function definition(): array
    {
        return [
            'truck_id' => Truck::factory(),
            'trailer_id' => Trailer::factory(),
            'first_driver_id' => Driver::factory(),
            'second_driver_id' => rand(0, 1) ? Driver::factory() : null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
