<?php

namespace Tests\Feature;

use App\User;
use App\Beers\Beer;
use App\Beers\Recipe;
use App\Beers\HopAddition;
use App\Beers\MaltAddition;
use App\Beers\YeastAddition;
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
        $response->assertStatus(200);
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

    public function testUserCanEditRecipe()
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
        $recipe = factory(Recipe::class)->create([
            'user_id' => $user->id,
        ]);

        // act
        $response = $this->actingAs($user)
            ->get(route('beers.recipes.edit', [$recipe->beer->slug, $recipe->id]));

        // assert 
        $response->assertStatus(200);
    }

    public function testUserCanUpdateRecipe()
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
        $recipe = factory(Recipe::class)->create([
            'user_id' => $user->id,
        ]);

        $recipe->abv = 5;
        $recipe->ibu = 60;
        $recipe->srm = 10;
        $recipe->og = 1.045;
        $recipe->fg = 1.005;

        $hops = factory(HopAddition::class)->make([
            'recipe_id' => null,
        ]);
        $malts = factory(MaltAddition::class)->make([
            'recipe_id' => null,
        ]);
        $yeasts = factory(YeastAddition::class)->make([
            'recipe_id' => null,
        ]);

        // act
        $response = $this->actingAs($user)
            ->followingRedirects()
            ->patch(
                route('beers.recipes.update', [$recipe->beer->slug, $recipe->id]), 
                array_merge(
                    $recipe->toArray(),
                    ['hops' => [$hops->toArray()]],
                    ['malts' => [$malts->toArray()]],
                    ['yeasts' => [$yeasts->toArray()]]
                )
            );

        // assert 
        $response->assertStatus(200);

        $this->assertDatabaseHas('recipes', [
            'id' => $recipe->id,
            'abv' => 5,
            'ibu' => 60,
            'srm' => 10,
            'og' => 1.045,
            'fg' => 1.005,
        ]);
        $this->assertDatabaseHas('hop_additions', [
            'hop_id' => $hops->hop_id,
            'recipe_id' => $recipe->id,
            'hop_type_id' => $hops->hop_type_id,
            'hop_method_id' => $hops->hop_method_id,
            'unit_id' => $hops->unit_id,
            'amount' => $hops->amount,
            'minute' => $hops->minute,
        ]);
        $this->assertDatabaseHas('malt_additions', [
            'malt_id' => $malts->malt_id,
            'recipe_id' => $recipe->id,
            'unit_id' => $malts->unit_id,
            'amount' => $malts->amount,
        ]);
        $this->assertDatabaseHas('yeast_additions', [
            'yeast_id' => $yeasts->yeast_id,
            'recipe_id' => $recipe->id,
        ]);
    }
}
