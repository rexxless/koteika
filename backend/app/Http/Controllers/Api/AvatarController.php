<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAvatarRequest;
use App\Services\AvatarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AvatarController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAvatarRequest $request, AvatarService $avatarService)
    {
        // без политики, аватар может быть у всех
        return $avatarService->store($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AvatarService $avatarService)
    {
        // без политики, аватар может быть у всех
        return $avatarService->destroy();
    }
}
