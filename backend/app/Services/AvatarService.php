<?php

namespace App\Services;

use App\Http\Requests\StoreAvatarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarService
{
    public function store(StoreAvatarRequest $request)
    {
        $user = auth()->user();

        $file = $request->file('avatar');

        $action = 'загружен';
        if (Storage::exists('avatars/' . $user->id)){
            $action = 'обновлен'; // если аватар уже был, напишем юзеру что аватар обновлен, а не загружен
            Storage::delete('avatars/' . $user->id);
        }
        $extension = $file->getClientOriginalExtension();

        $path = $file->storeAs(
            "avatars/{$user->id}",
            'avatar.' . $extension,
            'public'
        );

        $user->avatar = $path;
        $user->save();

        return response()->json([
            'message' => "Аватар успешно {$action}."
        ], 201);
    }

    public function destroy()
    {
        $user = auth()->user();
        $path = $user->avatar;

        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            $user->avatar = null;
            $user->save();
            return response()->json(['message' => 'Аватар успешно удален.']);
        } else {
            return response()->json(['message' => 'У вас отсутствует аватар.'], 404);
        }
    }
}
