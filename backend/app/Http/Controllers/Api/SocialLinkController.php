<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSocialLinkRequest;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Gate;

class SocialLinkController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSocialLinkRequest $request, SocialLink $socialLink)
    {
        Gate::authorize('create', $socialLink);
        SocialLink::query()->create([
            'social_network' => $request->social_network,
            'url' => $request->url
        ]);
        return response([
            'message' => 'Социальная сеть успешно добавлена.'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, SocialLink $socialLink)
    {
        Gate::authorize('create', $socialLink);
        SocialLink::query()->where('id', $id)->delete();
        return response([
            'message' => 'Социальная сеть успешно удалена.'
        ]);
    }
}
