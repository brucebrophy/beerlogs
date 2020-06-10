<?php

namespace Tests\Feature\Api;

use App\Events\CommentCreated;
use App\Mail\CommentNotification;
use App\User;
use App\Comment;
use App\Beers\Beer;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
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

    public function testGuestCanGetComments()
    {
        // arrange
        $beer = factory(Beer::class)->create();

        // act
        $response = $this->getJson('/api/beers/' . $beer->slug . '/comments');

        // assert
        $response->assertStatus(200);
    }

    public function testGuestCannotCreateComment()
    {
        // arrange
        $beer = factory(Beer::class)->create();

        // act
        $response = $this->postJson('/api/beers/' . $beer->slug . '/comments', [
            'body' => 'Hello World!'
        ]);

        // assert
        $response->assertStatus(401);
    }

    public function testGuestCannotUpdateComment()
    {
        // arrange
        $beer = factory(Beer::class)->create();
        $comment = factory(Comment::class)->make();
        $beer->comments()->save($comment);

        // act
        $response = $this->patchJson('/api/beers/' . $beer->slug . '/comments/' . $comment->id, [
            'body' => 'Updated!'
        ]);

        // assert
        $response->assertStatus(401);
    }

    public function testGuestCannotDeleteComment()
    {
        // arrange
        $beer = factory(Beer::class)->create();
        $comment = factory(Comment::class)->make();
        $beer->comments()->save($comment);

        // act
        $response = $this->deleteJson('/api/beers/' . $beer->slug . '/comments/' . $comment->id);

        // assert
        $response->assertStatus(401);
    }

    public function testUserCanCreateComment()
    {
        // arrange
        $beer = factory(Beer::class)->create();
        $user = factory(User::class)->create();
        Passport::actingAs($user);

        // act
        $response = $this->postJson('/api/beers/' . $beer->slug . '/comments', [
            'body' => 'Hello World!'
        ]);

        // assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('comments', [
            'body' => 'Hello World!',
            'user_id' => $user->id,
        ]);
    }

    public function testUserCanUpdateComment()
    {
        // arrange
        $beer = factory(Beer::class)->create();
        $user = factory(User::class)->create();
        $comment = factory(Comment::class)->create([
            'user_id' => $user->id,
            'commentable_id' => $beer->id,
            'commentable_type' => 'App\Beers\Beer',
        ]);

        Passport::actingAs($user);

        // act
        $response = $this->patchJson('/api/beers/' . $beer->slug . '/comments/' . $comment->id, [
            'body' => 'Updated!'
        ]);

        // assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('comments', [
            'body' => 'Updated!',
            'user_id' => $user->id,
        ]);
    }

    public function testUserCanDeleteComment()
    {
        // arrange
        $beer = factory(Beer::class)->create();
        $user = factory(User::class)->create();
        $comment = factory(Comment::class)->create([
            'user_id' => $user->id,
            'commentable_id' => $beer->id,
            'commentable_type' => 'App\Beers\Beer',
        ]);

        Passport::actingAs($user);

        // act
        $response = $this->deleteJson('/api/beers/' . $beer->slug . '/comments/' . $comment->id);

        // assert
        $response->assertStatus(200);
    }

    public function testUserCannotUpdateCommentOwnedByAnotherUser()
    {
        // arrange
        $beer = factory(Beer::class)->create();
        $user = factory(User::class)->create();
        $comment = factory(Comment::class)->create([
            'user_id' => $user->id,
            'commentable_id' => $beer->id,
            'commentable_type' => 'App\Beers\Beer',
        ]);

        Passport::actingAs(factory(User::class)->create());

        // act
        $response = $this->patchJson('/api/beers/' . $beer->slug . '/comments/' . $comment->id, [
            'body' => 'Updated!'
        ]);

        // assert
        $response->assertStatus(403);
    }

    public function testUserCannotDeleteCommentOwnedByAnotherUser()
    {
        // arrange
        $beer = factory(Beer::class)->create();
        $user = factory(User::class)->create();
        $comment = factory(Comment::class)->create([
            'user_id' => $user->id,
            'commentable_id' => $beer->id,
            'commentable_type' => 'App\Beers\Beer',
        ]);

        Passport::actingAs(factory(User::class)->create());

        // act
        $response = $this->deleteJson('/api/beers/' . $beer->slug . '/comments/' . $comment->id);

        // assert
        $response->assertStatus(403);
    }

    public function testBeerOwnerGetsNotificationOnNewComment()
    {
        Mail::fake();

        // arrange
        $owner = factory(User::class)->create();
        $user = factory(User::class)->create();
        $beer = factory(Beer::class)->create([
            'user_id' => $owner->id
        ]);
        Passport::actingAs($user);

        // act
        $this->postJson('/api/beers/' . $beer->slug . '/comments', [
            'body' => 'Hello World!'
        ]);

        // assert
        Mail::assertSent(CommentNotification::class, function ($mail) use ($owner) {
            return $mail->hasTo($owner->email);
        });
    }
}
