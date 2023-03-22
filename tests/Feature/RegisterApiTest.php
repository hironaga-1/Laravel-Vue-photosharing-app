<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegisterApiTest extends TestCase
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
    public function test_新しいユーザーを作成して返却する(): void
    {
        $data = [
            'name' => 'sample app user',
            'email' => 'dummy@email.com', 
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ];

        $response = $this->json('POST', route('register'), $data);

        $this->user = User::first();

        $this->assertEquals($data['name'], $this->user->name);
        
        $response->assertStatus(201)->assertJson(['name'=>$this->user->name]);
    }
}
