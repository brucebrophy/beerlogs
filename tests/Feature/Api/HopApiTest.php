<?php

namespace Tests\Feature\Api;

use HopSeeder;
use HopTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HopApiTest extends TestCase
{
    use RefreshDatabase;

    public function testCanListHops(Type $var = null)
    {
        // arrange
        $this->seed(HopSeeder::class);

        // act
        $response = $this->get('/api/hops');

        // assert
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                ['id' => 9, 'name' => 'Citra®']
            ]);
    }

    public function testCanListHopTypes(Type $var = null)
    {
        // arrange
        $this->seed(HopTypeSeeder::class);

        // act
        $response = $this->get('/api/hops/types');

        // assert
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                ['id' => 4, 'name' => 'Pellet Hops']
            ])
            ->assertJsonCount(6, 'types');
    }
}
