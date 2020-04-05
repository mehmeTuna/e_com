<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class staticPageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function homePAge()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function aboutPage()
    {
        $response = $this->get('hakkinda');

        $response->assertStatus(200);
    }

    public function galleryPage()
    {
        $response = $this->get('galeri');

        $response->assertStatus(200);
    }
}
