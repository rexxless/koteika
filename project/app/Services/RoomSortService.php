<?php

namespace App\Services;

use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class RoomSortService
{
    public function sorted()
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

        return RoomResource::collection($query->get());
    }
}
