<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fleet_sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('truck_id')->constrained('trucks')->onDelete('cascade');
            $table->foreignId('trailer_id')->constrained('trailers')->onDelete('cascade');
            $table->foreignId('first_driver_id')->nullable()->constrained('drivers');
            $table->foreignId('second_driver_id')->nullable()->constrained('drivers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fleet_sets');
    }
};
