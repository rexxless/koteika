<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AvailableBookingDates implements Rule
{
    protected $roomId;
    protected $checkIn;
    protected $checkOut;

    public function __construct($roomId, $checkIn, $checkOut)
    {
        $this->roomId = $roomId;
        $this->checkIn = $checkIn;
        $this->checkOut = $checkOut;
    }

    public function passes($attribute, $value)
    {
        return DB::table('bookings')
            ->where('room_id', $this->roomId)
            ->where(function ($query) {
                $query->whereBetween('check_in', [$this->checkIn, $this->checkOut])
                    ->orWhereBetween('check_out', [$this->checkIn, $this->checkOut])
                    ->orWhere(function ($query) {
                        $query->where('check_in', '<', $this->checkIn)
                            ->where('check_out', '>', $this->checkOut);
                    });
            })
            ->doesntExist();
    }

    public function message()
    {
        return 'Выбранные даты уже заняты.';
    }
}

