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
        return [
            'header' => [
                'title' => MainData::query()->get('title')->first()->title,
                'city' => MainData::query()->get('city')->first()->city,
                'slogan' => MainData::query()->get('slogan')->first()->slogan,
            ],
            'content' => [
                'feedbacks' => Feedback::inRandomOrder()->limit(5)->pluck('id')
            ],
            'footer' => [
                'address' => MainData::query()->get('address')->first()->address,
                'working_time' => MainData::query()->get('working_time')->first()->working_time,
                'phone' => MainData::query()->get('phone')->first()->phone,
                'email' => MainData::query()->get('email')->first()->email,
                'social_links' => SocialLink::all()
            ]
        ];
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

