<?php

namespace App\Services;

use App\Http\Requests\StoreFeedbackRequest;
use App\Models\Feedback;
use App\Models\Room;

class FeedbackService
{
    /**
     * Create a new class instance.
     */
    public function store(Room $room, StoreFeedbackRequest $request)
    {
        $data = $request->validated();
        $data['room_id'] = $room->id;
        $data['author'] = auth()->id();

        Feedback::query()->create($data);
        return response()->json(['message' => 'Отзыв успешно оставлен.'], 201);
    }
}
