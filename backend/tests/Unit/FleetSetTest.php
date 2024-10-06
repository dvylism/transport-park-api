<?php

namespace Tests\Unit;

use App\Enums\FleetSetStatus;
use App\Enums\MaintenanceStatus;
use App\Enums\ServiceOrderStatus;
use App\Models\FleetSet;
use App\Models\Maintenance;
use App\Models\ServiceOrder;
use App\Models\Trailer;
use App\Models\Truck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FleetSetTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function fleet_set_has_truck()
    {
        $truck = Truck::factory()->create();
        $fleetSet = FleetSet::factory()->create(['truck_id' => $truck->id]);

        $this->assertTrue($fleetSet->truck->is($truck));
    }

    #[Test]
    public function fleet_set_has_trailer()
    {
        $trailer = Trailer::factory()->create();
        $fleetSet = FleetSet::factory()->create(['trailer_id' => $trailer->id]);

        $this->assertTrue($fleetSet->trailer->is($trailer));
    }

    #[Test]
    public function fleet_set_has_truck_and_trailer()
    {
        $truck = Truck::factory()->create();
        $trailer = Trailer::factory()->create();

        $fleetSet = FleetSet::factory()->create([
            'truck_id' => $truck->id,
            'trailer_id' => $trailer->id,
        ]);

        $this->assertTrue($fleetSet->truck->is($truck));

        $this->assertTrue($fleetSet->trailer->is($trailer));
    }

    #[Test]
    public function returns_downtime_status_if_truck_is_under_service()
    {
        $truck = Truck::factory()->create();
        $trailer = Trailer::factory()->create();

        $fleetSet = FleetSet::factory()->create(
            [
                'truck_id' => $truck->id,
                'trailer_id' => $trailer->id,
            ]
        );

        Maintenance::factory()->create([
            'maintainable_id' => $truck->id,
            'maintainable_type' => Truck::class,
            'status' => MaintenanceStatus::IN_PROGRESS->value,
        ]);

        $this->assertEquals(FleetSetStatus::DOWNTIME->value, $fleetSet->status);
    }

    #[Test]
    public function returns_downtime_status_if_trailer_is_under_service()
    {
        $truck = Truck::factory()->create();
        $trailer = Trailer::factory()->create();

        $fleetSet = FleetSet::factory()->create(
            [
                'truck_id' => $truck->id,
                'trailer_id' => $trailer->id,
            ]
        );

        Maintenance::factory()->create([
            'maintainable_id' => $truck->id,
            'maintainable_type' => Truck::class,
            'status' => MaintenanceStatus::IN_PROGRESS->value,
        ]);

        $this->assertEquals(FleetSetStatus::DOWNTIME->value, $fleetSet->status);
    }

    #[Test]
    public function returns_works_status_if_fleet_set_is_in_service()
    {
        $fleetSet = FleetSet::factory()->create();

        ServiceOrder::factory()->create([
            'serviceable_id' => $fleetSet->id,
            'serviceable_type' => FleetSet::class,
            'status' => ServiceOrderStatus::IN_SERVICE->value,
        ]);

        $this->assertEquals(FleetSetStatus::WORKS->value, $fleetSet->status);
    }

    #[Test]
    public function fleet_set_is_in_service()
    {
        $model = FleetSet::factory()->create();

        $serviceOrder = ServiceOrder::factory()->create([
            'status' => ServiceOrderStatus::IN_SERVICE->value,
            'serviceable_id' => $model->id,
            'serviceable_type' => FleetSet::class,
        ]);

        $result = $model->isInService();

        $this->assertTrue($result);
    }

    #[Test]
    public function fleet_set_is_not_in_service()
    {
        $model = FleetSet::factory()->create();

        $serviceOrder = ServiceOrder::factory()->create([
            'status' => ServiceOrderStatus::COMPLETED->value,
            'serviceable_id' => $model->id,
            'serviceable_type' => FleetSet::class,
        ]);

        $result = $model->isInService();

        $this->assertFalse($result);
    }
}
