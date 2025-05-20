<?php

namespace App\Services;

use App\Http\Requests\StoreRoomRequest;
use App\Models\Amenity;
use App\Models\Room;
use App\Models\RoomAmenity;

class RoomService
{
    /**
     * Create a new class instance.
     */
    public function store(StoreRoomRequest $request)
    {
        $room = Room::create($request->except('amenities'));
        foreach ($request->amenities as $amenity) {
            RoomAmenity::create([
                'name' => $amenity,
                'room_id' => $room->id,
            ]);
        }


        return response()->json([
            'room_id' => $room->id,
            'message' => 'Комната создана успешно.',
            ]);
    }
}
