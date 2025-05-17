<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    use HasFactory;

    protected $primaryKey = 'social_network';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'social_network',
        'url',
    ];

    public $timestamps = false;
}
