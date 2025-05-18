<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\MainData;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'header' => [
                'title' => MainData::query()->get('title')->first(),
                'city' => MainData::query()->get('city')->first(),
                'slogan' => MainData::query()->get('slogan')->first(),
            ],
            'content' => [
                'feedbacks' => Feedback::inRandomOrder()->limit(5)->get()
            ],
            'footer' => [
                'address' => MainData::query()->get('address')->first(),
                'working_time' => MainData::query()->get('working_time')->first(),
                'phone' => MainData::query()->get('phone')->first(),
                'email' => MainData::query()->get('email')->first(),
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
