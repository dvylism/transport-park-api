<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\FleetSet;
use App\Models\Maintenance;
use App\Models\ServiceOrder;
use App\Models\Trailer;
use App\Models\Truck;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Truck::factory(10)->create();
        Trailer::factory(10)->create();
        Driver::factory(20)->create();
        FleetSet::factory(10)->create();
        Maintenance::factory(6)->create();
        ServiceOrder::factory(10)->create();
    }
}
