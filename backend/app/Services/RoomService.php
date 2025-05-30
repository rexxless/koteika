<?php

namespace App\Services;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\RoomResource;
use App\Http\Resources\RoomsResource;
use App\Models\Amenity;
use App\Models\Room;
use App\Models\RoomAmenity;
use Illuminate\Support\Facades\DB;

class RoomService
{
    /**
     * Create a new class instance.
     */
    public function store(StoreRoomRequest $request, Room $room)
    {
        $room = Room::create($request->except('amenities'));

        $photoService = new PhotoService();
        $photoService->store($request, $room);

        if (isset($request->amenities)) {
            foreach ($request->amenities as $amenity) {
                RoomAmenity::create([
                    'name' => $amenity,
                    'room_id' => $room->id,
                ]);
            }
        }

        return response()->json([
            'room_id' => $room->id,
            'message' => 'Номер успешно создан.',
            ]);
    }

    public function show(Room $room)
    {
        return RoomResource::make($room);
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update($request->validated());
        return response()->json([
            'message' => 'Номер успешно обновлён.',
            'room' => RoomResource::make($room)
        ]);
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(['message' => 'Номер успешно удален.']);
    }

    public function index()
    {
        $query = Room::query();

        if (request()->has('amenities')) {
            $amenities = explode('-', request()->amenities);

            foreach ($amenities as $amenity) {
                $query->whereHas('amenities', function ($q) use ($amenity) {
                    $q->where('amenities.name', $amenity);
                });
            }
        }

        if (request()->has('min_price')) {
            $min_price = request()->min_price;
            $query->where('price', '>', $min_price);
        }

        if (request()->has('max_price')) {
            $max_price = request()->max_price;
            $query->where('price', '<', $max_price);
        }

        if (request()->has('min_square')) {
            $min_square = request()->min_square;
            $query->where('width * length', '>', $min_square);
        }

        if (request()->has('max_square')) {
            $max_square = request()->max_square;
            $query->where('width * length', '<', $max_square);
        }

        if (request()-> has('sortby')) {
            if (request()->sortby === 'price_desc') {
                $query->orderByDesc('price');
            }
            if (request()->sortby === 'price_asc') {
                $query->orderBy('price');
            }
            if (request()->sortby === 'square_asc') {
                $query->orderBy(DB::raw('width * length'));
            }
            if (request()->sortby === 'square_desc') {
                $query->orderByDesc(DB::raw('width * length'));
            }
        } else {
            $query->orderBy('price');
        }

        // для плейсхолдеров на фронте
        $maxAllowablePrice = $query->max('price');
        $minAllowablePrice = $query->min('price');
        $allowableSquares = Room::query()
            ->selectRaw('width * length AS square')
            ->distinct()
            ->pluck('square');

        return response()->json([
            'rooms' => RoomsResource::collection($query->get()),
            'min_allowable_price' => $minAllowablePrice,
            'max_allowable_price' => $maxAllowablePrice,
            'allowable_squares' => $allowableSquares,
            'amenities' => Amenity::all()
        ]);
    }
}
