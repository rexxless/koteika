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

    public function amenities():HasMany
    {
        return $this->hasMany(RoomAmenity::class); # скорее всего неверная связь. надо проверить структуру удобств
    }
    protected $fillable =[
      'title',
      'description',
      'price',
      'showcase'
    ];

    protected $hidden = [
      'showcase'
    ];

    public $timestamps = false;
}
