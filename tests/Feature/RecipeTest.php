<?php

namespace Tests\Feature;

use App\User;
use App\Beers\Beer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserSeesRecipeCreatePageAfterCreatingBeer()
    {
        // arrange 
        $this->seed('BeerStyleSeeder');
        $user = factory(User::class)->create();
        $beer = factory(Beer::class)->make();

        // act 
        $response = $this->actingAs($user)
            ->followingRedirects()
            ->post(route('beers.store'), $beer->toArray());

        // assert
        $response->assertSee('Create Recipe');
    }
}
