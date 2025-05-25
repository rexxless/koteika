<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Models\Feedback;
use App\Models\Room;
use App\Services\FeedbackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FeedbackController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Feedback $feedback, StoreFeedbackRequest $request, FeedbackService $feedbackService)
    {
        Gate::authorize('create', $feedback);
        return $feedbackService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
       return $room->feedbacks()->select(['id', 'author', 'rate', 'title', 'description'])->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Feedback $feedback, UpdateFeedbackRequest $request, FeedbackService $feedbackService)
    {
        Gate::authorize('update', $feedback);
        return $feedbackService->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room, Feedback $feedback, FeedbackService $feedbackService)
    {
        Gate::authorize('delete', $feedback);
        return $feedbackService->destroy($room);

    }

    public function adminDestroy(Request $request, Feedback $feedback, FeedbackService $feedbackService)
    {
        Gate::authorize('adminDelete', $feedback);
        return $feedbackService->adminDestroy($request);
    }
}
