<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use App\Services\RoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoomService $roomService)
    {
        return $roomService->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request, RoomService $roomService, Room $room)
    {
        Gate::authorize('create', $room);
        return $roomService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room, RoomService $roomService)
    {
        return $roomService->show($room);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room, RoomService $roomService)
    {
        Gate::authorize('update', $room);
        return $roomService->update($request, $room);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room, RoomService $roomService)
    {
        Gate::authorize('destroy', $room);
        return $roomService->destroy($room);
    }
}
