<?php

namespace Tests\Feature\Api;

use UnitSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnitTest extends TestCase
{
    use RefreshDatabase;

    public function testCanListUnit()
    {
        // arrange
        $this->seed(UnitSeeder::class);

        // act
        $response = $this->get('/api/units');

        // assert
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                [
                    'id' => 1,
                    'name' => 'Ounce',
                    'symbol' => 'oz',
                ]
            ]);
    }
}
