<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePhotoRequest;
use App\Models\Photo;
use App\Models\Room;
use App\Services\PhotoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PhotoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(PhotoService $photoService, StorePhotoRequest $request, Photo $photo, Room $room)
    {
        Gate::authorize('create', $photo);
        return $photoService->store($request, $room);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhotoService $photoService, Room $room, Photo $photo)
    {
        Gate::authorize('delete', $photo);
        return $photoService->destroy($room, $photo);
    }
}
