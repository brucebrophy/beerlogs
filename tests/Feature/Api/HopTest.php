<?php

namespace Tests\Feature\Api;

use App\User;
use HopSeeder;
use HopTypeSeeder;
use HopMethodSeeder;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HopTest extends TestCase
{
    use RefreshDatabase;

    public function testCanListHops()
    {
        // arrange
        $this->seed(HopSeeder::class);
        Passport::actingAs(factory(User::class)->create());

        // act
        $response = $this->get('/api/hops');

        // assert
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                ['id' => 9, 'name' => 'Citra®']
            ]);
    }

    public function testCanListHopTypes()
    {
        // arrange
        $this->seed(HopTypeSeeder::class);
        Passport::actingAs(factory(User::class)->create());

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

    public function testCanListHopMethods()
    {
        // arrange
        $this->seed(HopMethodSeeder::class);
        Passport::actingAs(factory(User::class)->create());

        // act
        $response = $this->get('/api/hops/methods');

        // assert
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                ['id' => 3, 'name' => 'Boil']
            ])
            ->assertJsonCount(6, 'methods');
    }
}
