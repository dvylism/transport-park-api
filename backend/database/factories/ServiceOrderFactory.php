<?php

namespace Database\Factories;

use App\Enums\ServiceOrderStatus;
use App\Models\FleetSet;
use App\Models\ServiceOrder;
use App\Models\Trailer;
use App\Models\Truck;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceOrder>
 */
class ServiceOrderFactory extends Factory
{
    protected $model = ServiceOrder::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement([Truck::class, Trailer::class, FleetSet::class]);
        $serviceableId = null;

        switch ($type) {
            case Truck::class:
                $serviceableId = Truck::factory()->create()->id;
                break;
            case Trailer::class:
                $serviceableId = Trailer::factory()->create()->id;
                break;
            case FleetSet::class:
                $serviceableId = FleetSet::factory()->create()->id;
                break;
        }

        return [
            'serviceable_type' => $type,
            'serviceable_id' => $serviceableId,
            'status' => $this->faker->randomElement([ServiceOrderStatus::IN_SERVICE->value, ServiceOrderStatus::COMPLETED->value]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
