<?php

namespace App\Services;

use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

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
        return response()->json(['message' => 'Отзыв успешно оставлен'], 201);
    }

    public function update(UpdateFeedbackRequest $request)
    {
        $data = $request->validated();
        $data['room_id'] = $request->room;
        $data['author'] = auth()->id();

        $feedback = Feedback::query()->where([
            'room_id' => $data['room_id'],
            'author' => $data['author'],
        ]);
        if ($feedback->exists()) {
            $feedback->update([$data]);
            return response()->json(['message' => 'Отзыв успешно обновлён']);
        } else {
            return response()->json(['message' => 'Вы не оставляли отзыв об этом номере'], 404);
        }
    }

    public function destroy(Request $request)
    {
        $roomId = $request->room;
        $userId = auth()->id();
        $feedback = Feedback::query()->where([
            'room_id' => $roomId,
            'author' => $userId,
        ]);
        if ($feedback->exists()) {
            $feedback->delete();
            return response()->json(['message' => 'Отзыв успешно удалён']);
        } else {
            return response()->json(['message' => 'Вы не оставляли отзыв об этом номере'], 404);
        }
    }

    public function adminDestroy(Request $request)
    {
        $feedbackId = $request->feedback_id;
        $feedback = Feedback::query()->where('id', $feedbackId);
        if ($feedback->exists()) {
            $feedback->delete();
            return response()->json(['message' => 'Отзыв успешно удалён']);
        } else {
            return response()->json(['message' => 'Такого отзыва нет'], 404);
        }
    }
}
