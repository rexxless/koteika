<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAmenityRequest;
use App\Http\Requests\UpdateAmenityRequest;
use App\Models\Amenity;
use App\Services\AmenityService;
use Illuminate\Support\Facades\Gate;

class AmenityController extends Controller
{
    public function index(Amenity $amenity, AmenityService $amenityService)
    {
        Gate::authorize('index', $amenity);
        return $amenityService->index();
    }

    public function store(StoreAmenityRequest $request, Amenity $amenity, AmenityService $amenityService)
    {
        Gate::authorize('create', $amenity);
        return $amenityService->store($request);
    }

    public function show(Amenity $amenity, AmenityService $amenityService)
    {
        return $amenityService->show($amenity);
    }

    public function update(UpdateAmenityRequest $request, Amenity $amenity, AmenityService $amenityService)
    {
        Gate::authorize('update', $amenity);
        return $amenityService->update($request, $amenity);
    }

    public function destroy(Amenity $amenity, AmenityService $amenityService)
    {
        Gate::authorize('delete', $amenity);
        return $amenityService->destroy($amenity);
    }
}
