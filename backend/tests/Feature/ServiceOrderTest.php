<?php

namespace Tests\Feature;

use App\Models\ServiceOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ServiceOrderTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function fetch_all_service_orders()
    {
        ServiceOrder::factory()->count(5)->create();

        $response = $this->get(route('service-orders.index'));

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }

    #[Test]
    public function fetch_single_service_order()
    {
        $serviceOrder = ServiceOrder::factory()->create();

        $response = $this->get(route('service-orders.show', $serviceOrder->id));

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $serviceOrder->id,
            ],
        ]);
    }
}
