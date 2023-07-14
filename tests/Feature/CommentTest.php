<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function itCallsApiRoutesToGetComments(): void
    {
        $response = $this->get('/api/comments');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function itCallsApiRoutesToAddComments(): void
    {
        $response = $this->post('/api/comments/new', [
            'user_name' => 'user name ',
            'comment' => 'comment',
            'response_to' => '',
        ]);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function itReturnsABadRequestResponseIfThereAreInvalidData(): void
    {
        $response = $this->post('/api/comments/new', [
            'user_name' => 'user name ',
            'comment' => 'comment',
            'response_to' => 'wrongData',
        ]);

        $response->assertStatus(400);
    }
}
