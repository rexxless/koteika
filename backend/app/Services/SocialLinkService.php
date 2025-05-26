<?php

namespace App\Services;

use App\Http\Requests\StoreSocialLinkRequest;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Gate;

class SocialLinkService
{
    public function store(StoreSocialLinkRequest $request, SocialLink $socialLink)
    {
        SocialLink::query()->create([
            'social_network' => $request->social_network,
            'url' => $request->url
        ]);
        return response([
            'message' => 'Социальная сеть успешно добавлена.'
        ], 201);
    }

    public function destroy(string $id)
    {
        SocialLink::query()->where('id', $id)->delete();
        return response([
            'message' => 'Социальная сеть успешно удалена.'
        ]);
    }
}
