<?php

namespace Tests\Feature;

use App\Models\Truck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TruckTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function fetch_all_trucks()
    {
        Truck::factory()->count(5)->create();

        $response = $this->get(route('trucks.index'));

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }

    #[Test]
    public function fetch_single_truck()
    {
        $truck = Truck::factory()->create();

        $response = $this->get(route('trucks.show', $truck->id));

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $truck->id,
            ],
        ]);
    }
}
