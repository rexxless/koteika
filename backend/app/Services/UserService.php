<?php

namespace App\Services;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return auth()->user();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            unset($data['avatar']);
            $file = $request->file('avatar');
            if (Storage::exists('avatars/' . $user->id)){
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
        }


        $user->update($data);

        return response()->json([
            'message' => 'Данные обновлены',
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
