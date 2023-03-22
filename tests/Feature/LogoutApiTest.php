<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LogoutApiTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * A basic feature test example.
     */
    public function test_認証済みのユーザーをログアウトさせる(): void
    {
        $response = $this->actingAs($this->user)->json('POST', route('logout'));

        $response->assertStatus(200);

        $this->assertGuest();
    }
}
