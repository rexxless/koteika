<?php

namespace App\Services;

use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Models\Feedback;

class FeedbackService
{
    /**
     * Create a new class instance.
     */
    public function store(StoreFeedbackRequest $request)
    {
        $data = $request->validated();
        $data['room_id'] = $request->room;
        $data['author'] = auth()->id();

        if (Feedback::query()->where([
            'room_id' => $data['room_id'],
            'author' => $data['author'],
        ])->exists()) {
            return response()->json([
                'message' => 'Вы уже оставляли отзыв к этому номеру'
            ], 409);
        }

        Feedback::query()->create($data);
        return response()->json(['message' => 'Отзыв успешно оставлен.'], 201);
    }

    public function update(UpdateFeedbackRequest $request)
    {
        $data = $request->validated();
        $data['room_id'] = $request->room;
        $data['author'] = auth()->id();

        Feedback::query()->update($data);
        return response()->json(['message' => 'Отзыв успешно обновлён.']);
    }
}
