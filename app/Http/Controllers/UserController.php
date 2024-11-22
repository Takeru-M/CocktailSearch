<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request) {
        {
            // バリデーション
            $validated = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            // ユーザーをデータベースで検索
            $user = User::where('username', $validated['username'])->first();

            // ユーザーが見つからない場合
            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            // ログイン成功
            return response()->json(['message' => 'Login successful', 'user' => $user], 200);
        }
    }
}
