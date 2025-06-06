<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMainDataRequest;
use App\Models\Feedback;
use App\Models\MainData;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Gate;
use App\Services\MainPageService;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MainPageService $mainPageService)
    {
        return $mainPageService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMainDataRequest $request, MainData $mainData, MainPageService $mainPageService)
    {
        Gate::authorize('update', $mainData);
        return $mainPageService->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
