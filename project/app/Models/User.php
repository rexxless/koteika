<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar'
    ];

    protected $hidden = [
        'is_admin',
        'password'
    ];

    protected function casts()
    {
        return [
            'password' => 'hashed',
        ];
    }
    public $timestamps = false;
}
