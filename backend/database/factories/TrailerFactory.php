<?php

namespace Database\Factories;

use App\Models\Trailer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trailer>
 */
class TrailerFactory extends Factory
{
    protected $model = Trailer::class;

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
