<?php

namespace App\Http\Controllers\Api;

use App\Actions\DestroyAvatarAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Gate;

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
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, UserService $userService)
    {
        Gate::authorize('update', auth()->user());
        return $userService->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAvatar(DestroyAvatarAction $action)
    {
        return $action->handle();
    }
}
