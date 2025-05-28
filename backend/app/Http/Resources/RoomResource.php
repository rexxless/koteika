<?php

namespace App\Http\Resources;

use App\Models\Photo;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'preview' => Photo::query()->where('room_id', $this->id)
                ->first(['id', 'link']),
            'photos' => Photo::query()->where('room_id', $this->id)
                ->get(['id', 'link']),
            'description' => $this->description,
            'amenities' => $this->amenities()
                ->select(['room_amenities.name', 'icon'])
                ->get()
                ->makeHidden('pivot'),
            'price' => $this->price,
            'square' => $this->length * $this->width,
            'other_rooms' => Room::query()
                ->where('id', '!=', $this->id)
                ->inRandomOrder()
                ->limit(3)
                ->pluck('id')
                ->toArray()
        ];
    }
}
