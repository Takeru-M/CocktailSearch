<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use App\Models\Cocktail;
use App\Models\Favorite;
use App\Models\History;

class ApiVer1Test extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    public function test_registerHistory()
    {
        $user = User::first();
        $token = $user->createToken('Test Token')->plainTextToken;
        $cocktail = Cocktail::first();
        $cocktailID = $cocktail->cocktail_id;

        //The test for normal data
        $requestData = [
            'userID' => $user->id,
            'cocktailID' => $cocktailID,
        ];

        $response = $this->postJson('http://127.0.0.1:8000/api/registerHistory', $requestData, [
            'Authorization' => "Bearer $token",
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'History saved successfully',
        ]);

        $this->assertDatabaseHas('histories', [
            'user_id' => $user->id,
            'cocktail_id' => $cocktailID,
        ]);

        //The test for error data
        Log::shouldReceive('error')->once();

        $requestData = [
            'userID' => null,
            'cocktailID' => $cocktailID,
        ];

        $response = $this->postJson('http://127.0.0.1:8000/api/registerHistory', $requestData, [
            'Authorization' => "Bearer $token",
        ]);

        $response->assertStatus(500);
    }

    // /**
    //  * ログインIDの異常系テストデータ
    //  *
    //  * @return array
    //  */
    // public static function historyDataProvider() {
    //     $user = User::first();
    //     $cocktail = Cocktail::first();
    //     $cocktailID = $cocktail->cocktail_id;
    //     return [
    //         // 正常系テストデータ
    //         'valid_request' => [
    //             'userID' => $user->id,
    //             'cocktailID' => $cocktailID,
    //             'expectedStatus' => 201,
    //             'expectedMessage' => 'History saved successfully',
    //             'expectedLog' => null
    //         ],
    //         // 異常系テストデータ
    //         'invalid_user_id' => [
    //             'userID' => null,
    //             'cocktailID' => $cocktailID,
    //             'expectedStatus' => 500,
    //             'expectedMessage' => null,
    //             'expectedLog' => 'error'
    //         ]
    //     ];
    // }

    // /**
    //  * 異常系：ログインIDの指定がない場合のテスト
    //  * @dataProvider historyDataProvider
    //  */
    // public static function test_registerHistory($userId, $cocktailId, $expectedStatus, $expectedMessage, $expectedLog) {
    //     $user = User::first();
    //     $token = $user->createToken('Test Token')->plainTextToken;
    //     $cocktail = Cocktail::first();

    //     $requestData = [
    //         'userID' => $userId,
    //         'cocktailID' => $cocktailId,
    //     ];

    //     // エラーログのモック設定（異常系でエラーログを確認）
    //     if ($expectedLog) {
    //         Log::shouldReceive($expectedLog)->once();
    //     }

    //     // APIリクエスト送信
    //     $response = $this->postJson('http://127.0.0.1:8000/api/registerHistory', $requestData, [
    //         'Authorization' => "Bearer $token",
    //     ]);

    //     // レスポンスのステータスとメッセージ確認
    //     $response->assertStatus($expectedStatus);

    //     if ($expectedMessage) {
    //         $response->assertJson([
    //             'message' => $expectedMessage,
    //         ]);
    //     }

    //     // 正常系の場合、データベースにレコードが保存されていることを確認
    //     if ($expectedStatus == 201) {
    //         $this->assertDatabaseHas('histories', [
    //             'user_id' => $userId,
    //             'cocktail_id' => $cocktailId,
    //         ]);
    //     }
    // }
}
