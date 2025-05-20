<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'room_id',
        'check_in',
        'check_out',
        'pets',
        'user_id',
    ];

    protected $hidden = [
        'approved'
    ];

    public $timestamps = false;

}
