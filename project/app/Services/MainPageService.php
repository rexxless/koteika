<?php

namespace App\Services;

use App\Models\Feedback;
use App\Models\MainData;
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

}

