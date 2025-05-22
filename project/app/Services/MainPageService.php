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
        $mainData = MainData::query()->first();
        
        // Only update fields that are present in the request
        if ($request->has('header.title')) {
            $mainData->title = $request->input('header.title');
        }
        if ($request->has('header.city')) {
            $mainData->city = $request->input('header.city');
        }
        if ($request->has('header.slogan')) {
            $mainData->slogan = $request->input('header.slogan');
        }
        if ($request->has('footer.address')) {
            $mainData->address = $request->input('footer.address');
        }
        if ($request->has('footer.working_time')) {
            $mainData->working_time = $request->input('footer.working_time');
        }
        if ($request->has('footer.phone')) {
            $mainData->phone = $request->input('footer.phone');
        }
        if ($request->has('footer.email')) {
            $mainData->email = $request->input('footer.email');
        }
        
        $mainData->save();

        if ($request->has('footer.social_links')) {
            $socialLinks = $request->input('footer.social_links');
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

