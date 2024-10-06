<?php

namespace Tests\Feature;

use App\Models\FleetSet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FleetSetTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function fetch_all_fleet_sets()
    {
        FleetSet::factory()->count(5)->create();

        $response = $this->get(route('fleet-sets.index'));

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }

    #[Test]
    public function fetch_single_fleet_set()
    {
        $fleetSet = FleetSet::factory()->create();

        $response = $this->get(route('fleet-sets.show', $fleetSet->id));

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $fleetSet->id,
            ],
        ]);
    }
}
