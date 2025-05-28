<?php

namespace App\Services;

use App\Http\Requests\UpdateMainDataRequest;
use App\Models\Feedback;
use App\Models\MainData;
use App\Models\Room;
use App\Models\SocialLink;

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
        $mainData = MainData::query()->first();
        $mainData->update(request()->all());
        $mainData->save();

        if ($request->has('social_links')) {
            $socialLinks = $request->input('social_links');
            if (is_array($socialLinks)) {
                foreach ($socialLinks as $socialNetwork => $url) {
                    if ($url !== null) {
                        SocialLink::query()
                            ->where('social_network', $socialNetwork)
                            ->update(['url' => $url]);
                    }
                }
            }
        }

        return response()->json([
            'message' => 'Данные успешно обновлены.'
        ]);
    }

}

