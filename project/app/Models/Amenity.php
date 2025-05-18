<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Amenity extends Model
{
    use HasFactory;

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class); # скорее всего неверная связь, надо будет проверить
    }
    protected $fillable = [
        'name',
        'room_id'
    ];

    public $timestamps = false;
}
