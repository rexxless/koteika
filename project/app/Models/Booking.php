<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'check_in',
        'check_out',
        'user_id',
    ];

    protected $hidden = [
        'approved'
    ];
    public $timestamps = false;

}
