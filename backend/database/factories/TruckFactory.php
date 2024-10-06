<?php

namespace Database\Factories;

use App\Models\Truck;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Truck>
 */
class TruckFactory extends Factory
{
    protected $model = Truck::class;

    public function definition(): array
    {
        return [
            'model' => $this->faker->word(),
            'plate_number' => strtoupper($this->faker->bothify('???-###')),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
