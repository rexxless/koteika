<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedbackRequest;
use App\Models\Feedback;
use App\Models\Room;
use App\Services\FeedbackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Feedback $feedback, StoreFeedbackRequest $request, FeedbackService $feedbackService)
    {
        Gate::authorize('create', $feedback);
        return $feedbackService->store($feedback, $request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
       return $room->feedbacks()->select(['author', 'rate', 'title', 'description'])->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Feedback $feedback, UpdateFeedbackRequest $request, FeedbackService $feedbackService)
    {
        Gate::authorize('create', $feedback);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
