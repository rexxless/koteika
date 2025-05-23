<?php

namespace App\Services;

use App\Http\Requests\StoreAmenityRequest;

use App\Http\Requests\UpdateAmenityRequest;
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

    public function update(UpdateAmenityRequest $request, Amenity $amenity)
    {

        if ($request->has('name'))
        {
            $data = $request->only(['name']);
        }
        else
        {
            $data = [];
            $data["name"] = $amenity->name;
        }


        if ($request->hasFile('icon'))
        {
            $file = $request->file('icon');
            $path = $file->store('amenities/' . $data['name'], 'public');
            $data['icon'] = Storage::url($path);
        }

        $amenity->update($data);
        return response()->json(['amenity' => $amenity]);
    }


}
