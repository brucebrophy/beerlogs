<?php

namespace Tests\Feature\Api;

use App\User;
use YeastSeeder;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class YeastTest extends TestCase
{
    use RefreshDatabase;
    
    public function testCanListYeasts()
    {
        // arrange
        $this->seed(YeastSeeder::class);
        Passport::actingAs(factory(User::class)->create());

        // act
        $response = $this->get('/api/yeasts');

        // assert
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                ['id' => 1, 'name' => 'A01 House']
            ]);
    }
}
