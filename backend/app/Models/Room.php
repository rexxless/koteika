<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    public function feedbacks():HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'room_amenities', 'room_id', 'name', 'id', 'name');
    }

    protected $fillable =[
        'title',
        'description',
        'price',
        'showcase',
        'width',
        'height',
        'length'
    ];

    protected $hidden = [
      'showcase'
    ];

    public $timestamps = false;
}
