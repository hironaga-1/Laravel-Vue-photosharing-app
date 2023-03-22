<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserApiTest extends TestCase
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
    public function test_ログイン中のユーザーを返却する(): void
    {
        $response = $this->actingAs($this->user)->json('GET', route('user'));
        
        $response->assertStatus(200)->assertJson(['name'=> $this->user->name]);
    }

    /**
     * @test
     */
    public function test_ログインされていない場合は空文字を返却する(): void
    {
        $response = $this->json('GET', route('user'));

        $response->assertStatus(200);
        $this->assertEquals("", $response->content());
    }
}
