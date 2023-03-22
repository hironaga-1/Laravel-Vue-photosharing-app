<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginApiTest extends TestCase
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
    public function test_登録済みのユーザーを認証して返却する(): void
    {
        $response = $this->json('POST', route('login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)->assertJson((['name' => $this->user->name]));

        $this->assertAuthenticatedAs($this->user);
    }
}
