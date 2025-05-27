<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(UserService $userService)
    {
        return $userService->show();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, UserService $userService)
    {
        // Политика не нужна, т.к. профиль могут редачить любые авторизованные пользователи
        return $userService->update($request);
    }

}
