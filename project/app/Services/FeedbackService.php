<?php

namespace App\Services;

use App\Http\Requests\StoreFeedbackRequest;
use App\Models\Feedback;

class FeedbackService
{
    /**
     * Create a new class instance.
     */
    public function store(Feedback $feedback, StoreFeedbackRequest $request)
    {
        $data = $request->validated();
        $data['room_id'] = $request->room;
        $data['author'] = auth()->id();

        Feedback::query()->create($data);
        return response()->json(['message' => 'Отзыв успешно оставлен.'], 201);
    }
}
