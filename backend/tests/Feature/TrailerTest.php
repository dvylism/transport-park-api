<?php

namespace Tests\Feature;

use App\Models\Trailer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TrailerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function fetch_all_trailers()
    {
        Trailer::factory()->count(5)->create();

        $response = $this->get(route('trailers.index'));

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }

    #[Test]
    public function fetch_single_trailer()
    {
        $trailer = Trailer::factory()->create();

        $response = $this->get(route('trailers.show', $trailer->id));

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $trailer->id,
            ],
        ]);
    }
}
