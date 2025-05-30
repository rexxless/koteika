<?php

namespace App\Services;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Http\Resources\UserBookingResource;
use App\Models\Booking;
use App\Models\Pet;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingService
{
    public function index()
    {
        $bookings = Booking::with('pets')->get();
        return BookingResource::collection($bookings);
    }
    public function show()
    {
        $userId = auth()->id();
        $bookings = Booking::with('pets')->where('user_id', $userId)->get();

        return UserBookingResource::collection($bookings);
    }
    public function store(StoreBookingRequest $request, Room $room)
    {
        $data = $request->only(['check_in', 'check_out']);
        $data['room_id'] = $room->id;
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

        return response()->json([
            'message' => 'Бронь успешно создана.'
        ], 201);
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

    public function adminDestroy(Booking $booking)
    {
        $booking->pets()->delete();
        $booking->delete();
        return response()->json(['message' => 'Бронь успешно удалена.']);
    }

    public function approve(Booking $booking)
    {
        if ($booking->approved) {
            return response()->json(['message' => 'Бронь уже подтверждена.'], 409);
        }
        $booking->update(['approved' => true]);
        return response()->json(['message' => 'Бронь успешно подтверждена.']);
    }
}
