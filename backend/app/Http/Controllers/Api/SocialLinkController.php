<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSocialLinkRequest;
use App\Models\SocialLink;
use App\Services\SocialLinkService;
use Illuminate\Support\Facades\Gate;

class SocialLinkController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSocialLinkRequest $request, SocialLink $socialLink, SocialLinkService $socialLinkService)
    {
        Gate::authorize('create', $socialLink);
        return $socialLinkService->store($request, $socialLink);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialLink $socialLink, SocialLinkService $socialLinkService)
    {
        Gate::authorize('create', $socialLink);
        return $socialLinkService->destroy($socialLink);
    }
}
