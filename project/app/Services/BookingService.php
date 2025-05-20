<?php

namespace App\Services;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Pet;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingService
{
    public function create(StoreBookingRequest $request)
    {
        $data = $request->only(['room_id', 'check_in', 'check_out']);

        // Конвертируем в другой формат, т.к. бдшка не принимает d-m-Y
        $data['check_in'] = Carbon::createFromFormat('d-m-Y', $data['check_in'])->format('Y-m-d');
        $data['check_out'] = Carbon::createFromFormat('d-m-Y', $data['check_out'])->format('Y-m-d');
        $data['user_id'] = Auth::id();

        $book = Booking::query()->create($data);

        foreach ($request->pets as $petName) {
            Pet::query()->create([
                'name' => $petName,
                'booking_id' => $book->id
            ]);
        }

        return response()->json('Бронь успешно создана', 201);
    }

    public function destroy(Booking $booking)
    {
        if ($booking->user_id != Auth::id()) {
            return response()->json(['message'=> 'Вы не можете удалять чужие брони.'], 409);
        }

        if ($booking->approved) {
            return response()->json(['message'=> 'Бронь уже подтверждена, для удаления свяжитесь с администратором.'], 409);
        }

        Pet::query()->where('booking_id', $booking->id)->delete();
        $booking->delete();
        return response()->json(['message' => 'Бронь успешно удалена.']);
    }
}
