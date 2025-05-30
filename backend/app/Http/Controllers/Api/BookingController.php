<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Room;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request, Room $room, BookingService $bookingService)
    {
        Gate::authorize('create', Booking::class);
        return $bookingService->store($request, $room);
    }

    /**
     * Display the specified resource.
     */
    public function show(BookingService $bookingService, Booking $booking)
    {
        // тут или пользователь смотрит свои брони, или админ смотрит все брони
        if (auth()->user()->can('view', $booking)) {
            return $bookingService->show();
        } else if (auth()->user()->can('viewAll', $booking)) {
            return $bookingService->index();
        } abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking, BookingService $bookingService)
    {
        // тут или пользователь удаляет свою бронь, или админ удаляет любую
        if (auth()->user()->can('destroy', $booking)) {
            return $bookingService->destroy($booking);
        } else if (auth()->user()->can('adminDestroy', $booking)) {
            return $bookingService->adminDestroy($booking);
        } abort(403);
    }


    public function approve(Booking $booking, BookingService $bookingService)
    {
        Gate::authorize('approve', $booking);
        return $bookingService->approve($booking);
    }
}
