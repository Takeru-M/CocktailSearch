<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use App\Services\UserService;

class AuthController extends Controller
{
    protected $userService;

    public function __construct (UserService $userService) {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json(['message' => 'Logged in', 'token' => $token, 'user' => $user]);
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
            $name = $request->input('name');
            $email = $request->input('email');
            $password = Hash::make($request->input('password'));
            $user = $this->userService->createUser($name, $email, $password);

            $token = $user['result']->createToken('API Token')->plainTextToken;

            return response()->json(['message' => $user['message'], 'token' => $token, 'user' => $user['result']]);
        }
    }
}
