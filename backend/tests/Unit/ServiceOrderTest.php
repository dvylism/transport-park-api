<?php

namespace Tests\Unit;

use App\Models\FleetSet;
use App\Models\ServiceOrder;
use App\Models\Trailer;
use App\Models\Truck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ServiceOrderTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function service_order_belongs_to_fleet_set()
    {
        $fleetSet = FleetSet::factory()->create();

        $serviceOrder = ServiceOrder::factory()->create(['serviceable_id' => $fleetSet->id, 'serviceable_type' => FleetSet::class]);

        $this->assertTrue($serviceOrder->serviceable->is($fleetSet));
    }

    #[Test]
    public function service_order_belongs_to_truck()
    {
        $truck = Truck::factory()->create();

        $serviceOrder = ServiceOrder::factory()->create(['serviceable_id' => $truck->id, 'serviceable_type' => Truck::class]);

        $this->assertTrue($serviceOrder->serviceable->is($truck));
    }

    #[Test]
    public function service_order_belongs_to_trailer()
    {
        $trailer = Trailer::factory()->create();

        $serviceOrder = ServiceOrder::factory()->create(['serviceable_id' => $trailer->id, 'serviceable_type' => Trailer::class]);

        $this->assertTrue($serviceOrder->serviceable->is($trailer));
    }
}
