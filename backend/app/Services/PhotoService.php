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
        /* Не указываю тип для $request,
        т.к. загрузка может быть при создании комнаты (StoreRoomRequest),
        или при добавлении к существующей комнате фото (UpdateRoomRequest) */
    {
        $files = $request->file('photos');

        foreach ($files as $file) {
            // Сохраняем фото в БД, чтобы получить ID
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
            'message' => 'Загрузка фото прошла успешно',
            'room' => new RoomResource($room)
        ], 201);
    }

    public function destroy(Photo $photo)
    {
        $path = $photo->link;

        // Удаляем запись из БД
        $photo->delete();

        // Удаляем файл, если он существует
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        } else {
            return response()->json([
                'message' => 'Файл не найден в хранилище',
            ], 404);
        }

        return response()->json([
            'message' => 'Фотография успешно удалена'
        ]);
    }
}
