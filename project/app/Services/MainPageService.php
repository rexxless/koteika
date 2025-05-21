<?php

namespace App\Services;

use App\Http\Requests\UpdateMainDataRequest;
use App\Models\Feedback;
use App\Models\MainData;
use App\Models\Room;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class MainPageService
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainData = MainData::query()->first();

        return [
            'header' => [
                'title' => $mainData->title ?? null,
                'city' => $mainData->city ?? null,
                'slogan' => $mainData->slogan ?? null,
            ],
            'content' => [
                'rooms' => Room::query()->where('showcase', true)->get(),
                'feedbacks' => Feedback::inRandomOrder()->limit(5)->pluck('id')->toArray()
            ],
            'footer' => [
                'address' => $mainData->address ?? null,
                'working_time' => $mainData->working_time ?? null,
                'phone' => $mainData->phone ?? null,
                'email' => $mainData->email ?? null,
                'social_links' => SocialLink::all()
            ]
        ];
    }

    public function update(UpdateMainDataRequest $request)
    {
        MainData::query()->update([
            'title' => $request->header['title'],
            'city' => $request->header['city'],
            'slogan' => $request->header['slogan'],
            'address' => $request->footer['address'],
            'working_time' => $request->footer['working_time'],
            'phone' => $request->footer['phone'],
            'email' => $request->footer['email'],
        ]);

        foreach ($request->footer['social_links'] as $socialNetwork => $url) {
            SocialLink::query()
                ->where('social_network', $socialNetwork)
                ->update(['url' => $url]);
        }

        return response()->json([
            'message' => 'Данные успешно обновлены.'
        ]);
    }

}

