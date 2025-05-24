<?php

namespace App\Services;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function signup(StoreUserRequest $request)
    {
        User::create($request->validated());
        $user = User::query()->where('email', $request->email)->first();
        return response()->json([
            'token' => $user->createToken('token')->plainTextToken,
        ]
        );
    }

    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(['error' => 'Неправильный логин или пароль'], 401);
        }
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json([
            'token' => $user->createToken('token')->plainTextToken,
        ]);
    }
}
