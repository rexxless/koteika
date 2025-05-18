<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainData extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'city',
        'slogan',
        'phone',
        'email',
        'address',
        'working_time'
    ];

    public $timestamps = false;
}
