<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BeerTest extends TestCase
{
    public function testNonAuthenticatedUserCanViewBeerIndex()
    {
        $response = $this->get(route('beers.index'));
        $response->assertStatus(200);
    }
}
