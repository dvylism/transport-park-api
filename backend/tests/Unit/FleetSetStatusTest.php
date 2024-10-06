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

class FleetSetStatusTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function returns_downtime_if_truck_is_under_service()
    {
        $truck = Truck::factory()->create();
        $trailer = Trailer::factory()->create();

        $maintenance = Maintenance::factory()->create([
            'maintainable_id' => $truck->id,
            'maintainable_type' => Truck::class,
            'status' => MaintenanceStatus::IN_PROGRESS->value,
        ]);

        $fleetSet = FleetSet::factory()->create([
            'truck_id' => $truck->id,
            'trailer_id' => $trailer->id,
        ]);

        $status = $fleetSet->status;

        $this->assertEquals(FleetSetStatus::DOWNTIME->value, $status);
    }

    #[Test]
    public function returns_downtime_if_trailer_is_under_service()
    {
        $truck = Truck::factory()->create();
        $trailer = Trailer::factory()->create();

        $maintenance = Maintenance::factory()->create([
            'maintainable_id' => $trailer->id,
            'maintainable_type' => Trailer::class,
            'status' => MaintenanceStatus::IN_PROGRESS->value,
        ]);

        $fleetSet = FleetSet::factory()->create([
            'truck_id' => $truck->id,
            'trailer_id' => $trailer->id,
        ]);

        $status = $fleetSet->status;

        $this->assertEquals(FleetSetStatus::DOWNTIME->value, $status);
    }

    #[Test]
    public function returns_downtime_if_trailer_and_truck_is_under_service()
    {
        $truck = Truck::factory()->create();
        $trailer = Trailer::factory()->create();

        $maintenances = Maintenance::factory()->createMany(
            [
                [
                    'maintainable_id' => $trailer->id,
                    'maintainable_type' => Trailer::class,
                    'status' => MaintenanceStatus::IN_PROGRESS->value,
                ],
                [
                    'maintainable_id' => $truck->id,
                    'maintainable_type' => Truck::class,
                    'status' => MaintenanceStatus::IN_PROGRESS->value,
                ],
            ]
        );

        $fleetSet = FleetSet::factory()->create([
            'truck_id' => $truck->id,
            'trailer_id' => $trailer->id,
        ]);

        $status = $fleetSet->status;

        $this->assertEquals(FleetSetStatus::DOWNTIME->value, $status);
    }

    #[Test]
    public function returns_works_if_fleet_set_is_in_service_and_no_truck_or_trailer_is_under_service()
    {
        $truck = Truck::factory()->create();
        $trailer = Trailer::factory()->create();

        $fleetSet = FleetSet::factory()->create(
            [
                'truck_id' => $truck->id,
                'trailer_id' => $trailer->id,
            ]
        );

        ServiceOrder::factory()->create([
            'serviceable_id' => $fleetSet->id,
            'serviceable_type' => FleetSet::class,
            'status' => ServiceOrderStatus::IN_SERVICE->value,
        ]);

        $status = $fleetSet->status;

        $this->assertFalse($truck->isUnderService());
        $this->assertFalse($trailer->isUnderService());
        $this->assertTrue($fleetSet->isInService());

        $this->assertEquals(FleetSetStatus::WORKS->value, $status);
    }
}
