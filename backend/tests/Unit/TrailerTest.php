<?php

namespace Tests\Unit;

use App\Enums\MaintenanceStatus;
use App\Enums\ServiceOrderStatus;
use App\Models\Maintenance;
use App\Models\ServiceOrder;
use App\Models\Trailer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TrailerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function trailer_is_under_service()
    {
        $trailer = Trailer::factory()->create();

        Maintenance::factory()->create([
            'maintainable_id' => $trailer->id,
            'maintainable_type' => Trailer::class,
            'status' => MaintenanceStatus::IN_PROGRESS->value,
        ]);

        $this->assertTrue($trailer->isUnderService());
    }

    public function trailer_is_in_service()
    {
        $trailer = Trailer::factory()->create();

        ServiceOrder::factory()->create([
            'serviceable_id' => $trailer->id,
            'serviceable_type' => Trailer::class,
            'status' => ServiceOrderStatus::IN_SERVICE->value,
        ]);

        $this->assertTrue($trailer->isInService());
    }

    public function trailer_is_not_in_service()
    {
        $trailer = Trailer::factory()->create();

        ServiceOrder::factory()->create([
            'serviceable_id' => $trailer->id,
            'serviceable_type' => Trailer::class,
            'status' => ServiceOrderStatus::COMPLETED->value,
        ]);

        $this->assertFalse($trailer->isInService());
    }
}
