<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Photo;
use App\Models\User;

class AddCommentApiTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * @test
     */
    public function test_コメントを追加できる(): void
    {
        Photo::factory()->create();
        $photo = Photo::first();

        $content = 'sample content';

        $response = $this->actingAs($this->user)
            ->json('POST', route('photo.comment', [
                'photo' => $photo->id,
            ]), compact('content'));

        $comments = $photo->comments()->get();

        $response->assertStatus(201)
            ->assertJsonFragment([
                'author' => [
                    'name' => $this->user->name,
                ],
                'content' => $content,
            ]);

        $this->assertEquals(1, $comments->count());
        $this->assertEquals($content, $comments[0]->content);
    }
}
