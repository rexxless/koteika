<?php

namespace App\Services;

use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Http\Resources\FeedbackResourse;
use App\Models\Feedback;
use App\Models\Room;
use Illuminate\Http\Request;

class FeedbackService
{

    public function show(Room $room)
    {
        return $room->feedbacks()->select(['id', 'author', 'rate', 'title', 'description'])->get();
    }
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

    public function update(Room $room, UpdateFeedbackRequest $request)
    {
        $feedback = $room->feedbacks()->where('author', auth()->id());
        if ($feedback->exists()) {
            $feedback->update($request->validated());
            return response()->json([
                'message' => 'Отзыв успешно обновлён',
                'feedback' => FeedbackResourse::make($feedback->first())
            ]);
        } else {
            return response()->json(['message' => 'Вы не оставляли отзыв об этом номере.'], 404);
        }
    }

    public function destroy(Room $room)
    {
        $userId = auth()->id();
        if ($room->feedbacks()->where('author', $userId)->delete() === 1)
        {
            return response()->json(['message' => 'Отзыв успешно удален']);
        }
        else
        {
            return response()->json(['message' => 'Отзыв не найден'], 404);
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
