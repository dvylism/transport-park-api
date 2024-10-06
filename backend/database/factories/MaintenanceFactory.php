<?php

namespace Database\Factories;

use App\Enums\MaintenanceStatus;
use App\Models\Maintenance;
use App\Models\Trailer;
use App\Models\Truck;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maintenance>
 */
class MaintenanceFactory extends Factory
{
    protected $model = Maintenance::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement([Truck::class, Trailer::class]);
        $maintainableId = null;

        switch ($type) {
            case Truck::class:
                $maintainableId = Truck::factory()->create()->id;
                break;
            case Trailer::class:
                $maintainableId = Trailer::factory()->create()->id;
                break;
        }

        return [
            'maintainable_type' => $type,
            'maintainable_id' => $maintainableId,
            'status' => $this->faker->randomElement([MaintenanceStatus::IN_PROGRESS->value, MaintenanceStatus::COMPLETED->value]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
