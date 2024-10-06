<?php

namespace Database\Factories;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    protected $model = Driver::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'license_number' => strtoupper($this->faker->bothify('#########')),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
