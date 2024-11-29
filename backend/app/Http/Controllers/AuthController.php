<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
            // 'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // ユーザーを取得
        // $user = User::where('email', $request->email)->first();
        $user = User::where('name', $request->name)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // APIトークンを発行
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json(['message' => 'Logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function signin (Request $request) {
        {
            // リクエストバリデーション
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8', // パスワード確認フィールドが必要
            ]);

            // ユーザーの作成
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // パスワードのハッシュ化
            ]);

            // APIトークンを発行
            $token = $user->createToken('API Token')->plainTextToken;

            // ユーザー作成成功レスポンス
            return response()->json(['token' => $token, 'user' => $user]);
        }
    }
}
