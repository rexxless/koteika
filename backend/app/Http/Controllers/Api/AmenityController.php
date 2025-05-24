<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAmenityRequest;
use App\Http\Requests\UpdateAmenityRequest;
use App\Models\Amenity;
use App\Services\AmenityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AmenityController extends Controller
{
    public function index()
    {
        return response()->json(Amenity::all());
    }

    public function store(StoreAmenityRequest $request, Amenity $amenity, AmenityService $service)
    {
        Gate::authorize('create', $amenity);
        return $service->store($request);
    }

    public function show(Amenity $amenity)
    {
        return response()->json($amenity);
    }

    public function update(UpdateAmenityRequest $request, Amenity $amenity, AmenityService $service)
    {
        Gate::authorize('update', $amenity);
        $service->update($request, $amenity);
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
