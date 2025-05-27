<?php

namespace App\Services;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function signup(StoreUserRequest $request)
    {
        $data = $request->validated();
        return $data;
        unset($data['avatar']);

        $user = User::create($data);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();

            $path = $file->storeAs(
                "avatars/{$user->id}",
                'avatar.' . $extension,
                'public'
            );

            $user->avatar = $path;
            $user->save();
        }

        return response()->json([
            'token' => $user->createToken('token')->plainTextToken,
        ]);
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

    public function logout(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Успешный выход.'
        ]);
    }
}
