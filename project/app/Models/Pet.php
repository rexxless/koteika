<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pet extends Model
{
    use HasFactory;

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
    protected $fillable = [
        'name',
        'booking_id'
    ];

    public $timestamps = false;
}
