<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Beers\Beer;
use BeerStyleSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BeerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed('BeerStyleSeeder');
        $this->seed('HopSeeder');
        $this->seed('HopTypeSeeder');
        $this->seed('HopMethodSeeder');
        $this->seed('MaltSeeder');
        $this->seed('YeastSeeder');
        $this->seed('UnitSeeder');
    }

    public function testNonAuthenticatedUserCanViewIndex()
    {
        // arrange
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
        $user = factory(User::class)->create();
        $beer = factory(Beer::class)->make();

        // act
        $response = $this->followingRedirects()
            ->actingAs($user)
            ->post(route('beers.store'), $beer->toArray());

        // assert
        $response
            ->assertStatus(200)
            ->assertSee('Create Recipe');

        $this->assertDatabaseHas('beers', [
            'name' => $beer->name,
            'notes' => $beer->notes,
        ]);
    }

    public function testAuthenticatedUserCanEditResource()
    {
        // arrange
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
        $user = factory(User::class)->create();
        $beer = factory(Beer::class)->create();

        // act
        $response = $this->actingAs($user)
            ->get(route('beers.edit', $beer->slug));

        // assert
        $response
            ->assertStatus(403);
    }

    public function testAuthenticatedUserCanUpdateResource()
    {
        // arrange
        $user = factory(User::class)->create();
        $beer = factory(Beer::class)->create([
            'user_id' => $user->id
        ]);

        $beer->name = 'Testing Beer Update';

        // act
        $response = $this->followingRedirects()
            ->actingAs($user)
            ->patch(route('beers.update', $beer->slug), $beer->toArray());

        // assert
        $response
            ->assertStatus(200)
            ->assertSee('Testing Beer Update');

        $this->assertDatabaseHas('beers', [
            'name' => 'Testing Beer Update'
        ]);
    }

    public function testAuthenticatedUserCannotDeleteRecordIfNameIsNotConfirmed()
    {
        // arrange
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
        $user = factory(User::class)->create();
        $beer = factory(Beer::class)->create([
            'user_id' => $user->id
        ]);

        // act
        $response = $this->followingRedirects()
            ->actingAs($user)
            ->delete(route('beers.destroy', $beer->slug), [
                'confirm_name' => $beer->name,
            ]);

        // assert
        $response->assertStatus(200);
        $this->assertDeleted($beer);
    }
}
