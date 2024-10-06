<?php

namespace Tests\Unit;

use App\Enums\MaintenanceStatus;
use App\Enums\ServiceOrderStatus;
use App\Models\Maintenance;
use App\Models\ServiceOrder;
use App\Models\Truck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TruckTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function truck_is_under_service()
    {
        $truck = Truck::factory()->create();

        Maintenance::factory()->create([
            'maintainable_id' => $truck->id,
            'maintainable_type' => Truck::class,
            'status' => MaintenanceStatus::IN_PROGRESS->value,
        ]);

        $this->assertTrue($truck->isUnderService());
    }

    public function truck_is_in_service()
    {
        $truck = Truck::factory()->create();

        ServiceOrder::factory()->create([
            'serviceable_id' => $truck->id,
            'serviceable_type' => Truck::class,
            'status' => ServiceOrderStatus::IN_SERVICE->value,
        ]);

        $this->assertTrue($truck->isInService());
    }

    public function truck_is_not_in_service()
    {
        $truck = Truck::factory()->create();

        ServiceOrder::factory()->create([
            'serviceable_id' => $truck->id,
            'serviceable_type' => Truck::class,
            'status' => ServiceOrderStatus::COMPLETED->value,
        ]);

        $this->assertFalse($truck->isInService());
    }
}
