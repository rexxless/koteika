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

    public function photos()
    {
        return $this->hasMany(Photo::class);
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

    /**
     * Resolve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        if (!is_numeric($value)) {
            return null;
        }
        return parent::resolveRouteBinding($value, $field);
    }
}
