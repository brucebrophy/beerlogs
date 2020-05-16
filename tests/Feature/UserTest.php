<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use BeerStyleSeeder;
use App\Beers\Beer;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestsCanViewProfiles()
    {
        // arrange
        $user = factory(User::class)->create();

        // act
        $this->get(route('users.show', $user->username))
            ->assertStatus(200);
    }

    public function testUsersBeersAreShownOnTheirProfile()
    {
        // arrange 
        $this->seed(BeerStyleSeeder::class);
        $user = factory(User::class)->create();
        $beer = factory(Beer::class)->create([ 'user_id' => $user->id ]);

        // act
        $this->get(route('users.show', $user->username))
            ->assertStatus(200)
            ->assertSee($beer->name);
    }

    public function testUserCanEditOwnProfile()
    {
        // arrange
        $user = factory(User::class)->create();

        // act
        $this->actingAs($user)
            ->get(route('users.edit', $user->username))
            ->assertStatus(200);
    }

    public function testUserCanOnlyEditOwnProfile()
    {
        // arrange
        $badUser = factory(User::class)->create();
        $user = factory(User::class)->create();

        // act
        $this->actingAs($badUser)
            ->get(route('users.edit', $user->username))
            ->assertStatus(403);
    }

    public function testUserCanUpdateOwnProfile()
    {
        // arrange 
        $user = factory(User::class)->create();

        // act
        $response = $this->actingAs($user)
            ->patch(route('users.update', $user->username), [
                'name' => 'Testing McTest'
            ]);

        // assert
        $response->status(200);
        $this->assertDatabaseHas('users', [
            'id' => $user->id, 
            'name' => 'Testing McTest', 
        ]);
    }

    public function testUserCannotChangeUserName()
    {
        // arrange 
        $user = factory(User::class)->create();

        // act
        $response = $this->actingAs($user)
            ->patch(route('users.update', $user->username), [
                'username' => 'testTesting'
            ]);

        // assert
        $response->status(200);
        $this->assertDatabaseHas('users', [
            'username' => $user->username, 
        ]);
        $this->assertDatabaseMissing('users', [
            'username' => 'testTesting', 
        ]);
    }

    public function testUserCanOnlyUpdateOwnProfile()
    {
        // arrange
        $badUser = factory(User::class)->create();
        $user = factory(User::class)->create();

        // act
        $response = $this->actingAs($badUser)
            ->patch(route('users.update', $user->username), [
                'name' => 'Testing McTest'
            ]);
        
        // assert
        $response->status(403);
        $this->assertDatabaseHas('users', [
            'id' => $user->id, 
            'name' => $user->name, 
        ]);
    }

    public function testUserCanDeleteOwnProfile()
    {
        // arrange 
        $user = factory(User::class)->create();

        // act
        $response = $this->actingAs($user)
            ->delete(route('users.destroy', $user->username), [
                'username' => $user->username
            ]);
    
        // assert
        $response->status(200);
        $this->assertDatabaseMissing('users', [
            'id' => $user->id, 
            'username' => $user->username, 
            'email' => $user->email, 
        ]);
    }

    public function testUserCanOnlyDeleteOwnProfile()
    {
        // arrange 
        $badUser = factory(User::class)->create();
        $user = factory(User::class)->create();

        // act
        $response = $this->actingAs($badUser)
            ->delete(route('users.destroy', $user->username), [
                'username' => $user->username
            ]);
    
        // assert
        $response->status(403);
        $this->assertDatabaseHas('users', [
            'id' => $user->id, 
            'username' => $user->username, 
            'email' => $user->email, 
        ]);
    }
}
