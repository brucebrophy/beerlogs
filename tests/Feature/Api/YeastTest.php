<?php

namespace Tests\Feature\Api;

use YeastSeeder;
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
