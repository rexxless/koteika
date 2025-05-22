<?php

namespace App\Services;

use App\Http\Requests\StoreAmenityRequest;

use App\Models\Amenity;
use Illuminate\Support\Facades\Storage;

class AmenityService
{
    /**
     * Create a new class instance.
     */
    public function store(StoreAmenityRequest $request)
    {
        $data = $request->only(['name']);

        $file = $request->file('icon');
        $path = $file->store('amenities/' . $data['name'], 'public');
        $data['icon'] = Storage::url($path);


        $amenity = Amenity::query()->create($data);

        return response()->json([
            'message' => 'Оснащение номера успешно добавлено',
            'amenity' => $amenity
        ], 201);
    }

}
