<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use BeerStyleSeeder;

use App\Models\User;
use App\Models\Beers\Beer;

class BeerTest extends TestCase
{
    use RefreshDatabase;
    
    public function testNonAuthenticatedUserCanViewIndex()
    {
        // arrange
        $this->seed(BeerStyleSeeder::class);
        $beer = factory(Beer::class)->create();

        // act
        $response = $this->get(route('beers.index'));

        // assert
        $response
            ->assertStatus(200)
            ->assertSee($beer->name);
    }

    public function testNonAuthenticatedUserCannotCreateRecord()
    {
         // arrange
        $this->seed(BeerStyleSeeder::class);
        $beer = factory(Beer::class)->make();

        // act
        $response = $this->followingRedirects()
            ->post(route('beers.store'), $beer->toArray());

        // assert
        $response
            ->assertSee('Login');
    }

    public function testAuthenticatedUserCanCreateRecord()
    {
         // arrange
        $this->seed(BeerStyleSeeder::class);
        $user = factory(User::class)->create();
        $beer = factory(Beer::class)->make();

        // act
        $response = $this->followingRedirects()
            ->actingAs($user)
            ->post(route('beers.store'), $beer->toArray());

        // assert
        $response
            ->assertStatus(200)
            ->assertSee($beer->name)
            ->assertSee($beer->description);
    }
}
