<?php

namespace App\Services;

use App\Http\Requests\StoreAmenityRequest;

use App\Http\Requests\UpdateAmenityIconRequest;
use App\Http\Requests\UpdateAmenityNameRequest;
use App\Models\Amenity;
use Illuminate\Support\Facades\Storage;

class AmenityService
{

    public function index()
    {
        return Amenity::all();
    }

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

    public function show(Amenity $amenity)
    {
        return response()->json($amenity);
    }

    public function update(UpdateAmenityNameRequest $request, Amenity $amenity)
    {
        $amenity->update($request->only(['name']));
        return response()->json([
            'message' => 'Оснащение номера успешно обновлено.',
            'amenity' => $amenity
        ]);
    }

    public function updateIcon(UpdateAmenityIconRequest $request, Amenity $amenity)
    {
        $file = $request->file('icon');

        // тестовые данные есть в БД, но не загружаются в Storage, а в основном такая проверка не потребуется
        if (Storage::exists('amenities/' . $amenity->name)) {
            Storage::delete('amenities/' . $amenity->name);
        }
        if ($request->hasFile('icon')) {
            $extension = $file->getClientOriginalExtension();
            $path = $file->storeAs(
                'amenities/' . $amenity->name,
                'icon.' . $extension,
                'public');

            $data = [];
            $data['icon'] = Storage::url($path);
            $amenity->update($data);
        }

        return response()->json([
            'message' => 'Оснащение номера успешно обновлено.',
            'amenity' => $amenity
        ]);
    }

    public function destroy(Amenity $amenity)
    {
        $amenity->delete();
        return response()->json(['message' => 'Оснащение номера удалено.']);
    }
}
