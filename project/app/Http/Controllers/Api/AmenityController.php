<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAmenityRequest;
use App\Http\Requests\UpdateAmenityRequest;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AmenityController extends Controller
{
    public function index()
    {
        return response()->json(Amenity::all());
    }

    public function store(StoreAmenityRequest $request, Amenity $amenity)
    {
        Gate::authorize('create', $amenity);
        $amenity = Amenity::create($request->validated());
        return response()->json([
            'message' => 'Оснащение номера успешно добавлено.',
            'amenity' => $amenity
        ], 201);
    }

    public function show(Amenity $amenity)
    {
        return response()->json($amenity);
    }

    public function update(UpdateAmenityRequest $request, Amenity $amenity)
    {
        Gate::authorize('update', $amenity);
        $amenity->update($request->validated());
        return response()->json([
            'message' => 'Оснащение номера успешно обновлено.',
            'amenity' => $amenity
        ]);
    }

    public function destroy(Amenity $amenity)
    {
        Gate::authorize('delete', $amenity);
        $amenity->delete();
        return response()->json(['message' => 'Оснащение номера удалено.']);
    }
}
