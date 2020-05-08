<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use BeerStyleSeeder;
use App\Models\Beers\Beer;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

    public function testNonAuthenticatedUserCannotViewCreateForm()
    {
        // act
        $response = $this->followingRedirects()
            ->get(route('beers.create'));

        // assert
        $response
            ->assertStatus(200)
            ->assertSee('Login');
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
        $response->assertSee('Login');
        
        $this->assertDatabaseMissing('beers', [
            'name' => $beer->name,
            'notes' => $beer->notes,
        ]);
    }

    public function testNonAuthenticatedUserCannotEditResource()
    {
        // arrange
        $this->seed(BeerStyleSeeder::class);
        $beer = factory(Beer::class)->create();

        // act
        $response = $this->followingRedirects()
            ->get(route('beers.edit', $beer->id));

        // assert
        $response
            ->assertStatus(200)
            ->assertSee('Login');
    }

    public function testNonAuthenticatedUserCannotDeleteRecord()
    {
        // arrange
        $this->seed(BeerStyleSeeder::class);
        $beer = factory(Beer::class)->create();

        // act
        $response = $this->followingRedirects()
            ->delete(route('beers.destroy', $beer->slug), [
                'name' => 'foobar',
            ]);

        // assert
        $response->assertStatus(200)
            ->assertSee('Login');
            
        $this->assertDatabaseHas('beers', [
            'id' => $beer->id,
            'name' => $beer->name,
        ]);
    }

    public function testAuthenticatedUserCanViewCreateForm()
    {
        // arrange
        $user = factory(User::class)->make();

        // act
        $response = $this->followingRedirects()
            ->actingAs($user)
            ->get(route('beers.create'));

        // assert
        $response
            ->assertStatus(200)
            ->assertSee('Continue to Recipe');
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

    public function testAuthenticatedUserCanEditResource()
    {
        // arrange
        $this->seed(BeerStyleSeeder::class);
        $user = factory(User::class)->create();
        $beer = factory(Beer::class)->create([
            'user_id' => $user->id
        ]);

        // act
        $response = $this->actingAs($user)
            ->get(route('beers.edit', $beer->slug));

        // assert
        $response
            ->assertStatus(200);
    }

    public function testAuthenticatedUserCanOnlyEditOwnedResource()
    {
        // arrange
        $this->seed(BeerStyleSeeder::class);
        $user = factory(User::class)->create();
        $beer = factory(Beer::class)->create();

        // act
        $response = $this->actingAs($user)
            ->get(route('beers.edit', $beer->slug));

        // assert
        $response
            ->assertStatus(403);
    }

    public function testAuthenticatedUserCannotDeleteRecordIfNameIsNotConfirmed()
    {
        // arrange
        $this->seed(BeerStyleSeeder::class);
        $user = factory(User::class)->create();
        $beer = factory(Beer::class)->create([
            'user_id' => $user->id
        ]);

        // act
        $response = $this->followingRedirects()
            ->actingAs($user)
            ->delete(route('beers.destroy', $beer->slug), [
                'name' => 'foobar',
            ]);

        // assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('beers', [
            'id' => $beer->id,
            'name' => $beer->name,
        ]);
    }

    public function testAuthenticatedUserCanDeleteResource()
    {
        // arrange
        $this->seed(BeerStyleSeeder::class);
        $user = factory(User::class)->create();
        $beer = factory(Beer::class)->create([
            'user_id' => $user->id
        ]);

        // act
        $response = $this->followingRedirects()
            ->actingAs($user)
            ->delete(route('beers.destroy', $beer->slug), [
                'name' => $beer->name,
            ]);

        // assert
        $response->assertStatus(200);
        $this->assertDeleted($beer);
    }
}
