<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Photo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PhotoListApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_正しい構造のJSONを返却する(): void
    {
        // 5つの写真データを生成する
        Photo::factory(5)->create();

        $response = $this->json('GET', route('photo.index'));

        // 生成した写真データを作成日降順で取得
        $photos = Photo::with(['owner'])->orderBy('created_at', 'desc')->get();

        // data項目の期待値
        $expected_data = $photos->map(function ($photo) {
            return [
                'id' => $photo->id,
                'url' => $photo->url,
                'owner' => [
                    'name' => $photo->owner->name,
                ],
                'liked_by_user' => false,
                'likes_count' => 0,
            ];
        })->all();

        $response->assertStatus(200)
                // レスポンスJSONのdata項目に含まれる要素が5つであること
                ->assertJsonCount(5, 'data')
                // レスポンスJSONのdata項目が期待値と合致すること
                ->assertJsonFragment([
                    "data" => $expected_data,
                ]);
    }
}
