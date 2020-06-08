<?php

namespace Tests\Feature\Api;

use App\User;
use MaltSeeder;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MaltTest extends TestCase
{
    use RefreshDatabase;

    public function testCanListMalts()
    {
        // arrange
        $this->seed(MaltSeeder::class);
        Passport::actingAs(factory(User::class)->create());

        // act
        $response = $this->get('/api/malts');

        // assert
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                ['id' => 1, 'name' => 'Pilsner Malt']
            ]);
    }
}
