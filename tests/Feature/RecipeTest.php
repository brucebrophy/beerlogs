<?php

namespace Tests\Feature;

use App\User;
use App\Beers\Beer;
use App\Beers\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testUserCanOnlySeeCreateForBeersTheyOwnPage()
    {
        // arrange
        $this->seed('BeerStyleSeeder');
        $this->seed('HopSeeder');
        $this->seed('HopTypeSeeder');
        $this->seed('HopMethodSeeder');
        $this->seed('MaltSeeder');
        $this->seed('YeastSeeder');
        $this->seed('UnitSeeder');

        $user = factory(User::class)->create();
        $beer = factory(Beer::class)->create();

        // act 
        $response = $this->actingAs($user)
            ->get(route('beers.recipes.create', $beer->slug), $beer->toArray());


        // assert
        $response->assertStatus(403);
    }
    
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
        $response->assertStatus(200)
            ->assertSee('Create Recipe');
    }

    public function testUserCanCreateRecipe()
    {
        // arrange
        $this->seed('BeerStyleSeeder');
        $this->seed('HopSeeder');
        $this->seed('HopTypeSeeder');
        $this->seed('HopMethodSeeder');
        $this->seed('MaltSeeder');
        $this->seed('YeastSeeder');
        $this->seed('UnitSeeder');

        $user = factory(User::class)->create();
        $beer = factory(Beer::class)->create([
            'user_id' => $user->id,
        ]);
        $recipe = factory(Recipe::class)->make();

        // act
        $response = $this->actingAs($user)
            ->followingRedirects()
            ->post(route('beers.recipes.store', $beer->slug), $recipe->toArray());

        // assert 
        $response->assertStatus(200);

        $this->assertDatabaseHas('recipes', [
            'instructions' => $recipe->instructions,
            'abv' => $recipe->abv,
            'ibu' => $recipe->ibu,
            'og' => $recipe->og,
            'fg' => $recipe->fg,
            'srm' => $recipe->srm,
            'batch_size' => $recipe->batch_size,
        ]);
    }
}
