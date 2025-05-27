<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;

class DestroyAvatarAction
{
    /**
     * Create a new class instance.
     */
    public function handle()
    {
        $user = auth()->user();
        $path = $user->avatar;
        
        if ($path) {
            Storage::delete($path);
            $user->avatar = null;
            $user->save();
            return response()->json(['message' => 'Аватар успешно удален.']);
        } else {
            return response()->json(['message' => 'У пользователя отсутствует аватар.'], 404);
        }
    }
}
