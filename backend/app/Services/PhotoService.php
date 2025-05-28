<?php

namespace App\Services;

use App\Http\Requests\StorePhotoRequest;
use App\Http\Resources\RoomResource;
use App\Models\Photo;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoService
{
    public function store($request, Room $room)
    {
        $files = $request->file('photos');

        foreach ($files as $file) {

            $photo = $room->photos()->create([
                'link' => '.',
            ]); // создаём запись, получаем ID

            // Теперь строим имя файла: {id}.{расширение}
            $extension = $file->getClientOriginalExtension();
            $filename = $photo->id . '.' . $extension;

            // Сохраняем файл по пути: rooms/{room_id}/{filename}
            $path = $file->storeAs("rooms/{$room->id}", $filename, 'public');

            // Обновляем запись с путём
            $photo->update(['link' => $path]);
        }

        return response()->json([
            'message' => 'Загрузка фото прошла успешно.',
            'room' => new RoomResource($room)
        ], 201);
    }

    public function destroy(Photo $photo)
    {
        $path = $photo->link;

        $photo->delete();

        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        } else {
            return response()->json([
                'message' => 'Фотография не найдена.',
            ], 404);
        }

        return response()->json([
            'message' => 'Фотография успешно удалена.'
        ]);
    }
}
