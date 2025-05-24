<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(StoreUserRequest $request, AuthService $authService)
    {
        return $authService->signup($request);
    }

    public function login(LoginUserRequest $request, AuthService $authService)
    {
        return $authService->login($request);
    }

    public function logout(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Успешный выход.'
        ]);
    }
}
