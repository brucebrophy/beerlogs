<?php

namespace Tests\Browser;

use App\Beers\Beer;
use App\Comment;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CommentTest extends DuskTestCase
{
    use DatabaseMigrations;

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

    public function testGuestCannotComment()
    {
        $beer = factory(Beer::class)->create();

        $this->browse(function (Browser $browser) use ($beer) {
            $browser->visit(route('beers.show', $beer->slug))
                    ->assertSee('COMMENTS')
                    ->assertSee('Login to comment')
                    ->assertDontSee('Add Comment');
        });
    }

    public function testUserCanCreateComment()
    {
        $beer = factory(Beer::class)->create();
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user, $beer) {
            $browser->loginAs($user)
                ->visit(route('beers.show', $beer->slug))
                ->type('body', 'Hello World')
                ->press('Add Comment')
                ->pause(500);
        });

        $this->assertDatabaseHas('comments', [
            'body' => 'Hello World',
            'user_id' => $user->id
        ]);
    }

    public function testUserCanEditComment()
    {
        $beer = factory(Beer::class)->create();
        $user = factory(User::class)->create();
        factory(Comment::class)->create([
            'user_id' => $user->id,
            'commentable_id' => $beer->id,
            'commentable_type' => 'App\Beers\Beer',
        ]);

        $this->browse(function (Browser $browser) use ($user, $beer) {
            $browser->loginAs($user)
                ->visit(route('beers.show', $beer->slug))
                ->scrollIntoView('#body')
                ->pause(300)
                ->clickLink('Edit')
                ->type('body', 'Updated!')
                ->press('Add Comment')
                ->pause(200);
        });

        $this->assertDatabaseHas('comments', [
            'body' => 'Updated!',
            'user_id' => $user->id
        ]);
    }

    public function testUserCanDeleteComment()
    {
        $beer = factory(Beer::class)->create();
        $user = factory(User::class)->create();
        factory(Comment::class)->create([
            'user_id' => $user->id,
            'body' => 'I am going to be deleted!',
            'commentable_id' => $beer->id,
            'commentable_type' => 'App\Beers\Beer',
        ]);

        $this->browse(function (Browser $browser) use ($user, $beer) {
            $browser->loginAs($user)
                ->visit(route('beers.show', $beer->slug))
                ->scrollIntoView('#body')
                ->pause(300)
                ->clickLink('Delete')
                ->pause(200);
        });

        $this->assertDatabaseMissing('comments', [
            'body' => 'I am going to be deleted!',
            'user_id' => $user->id
        ]);
    }
}
