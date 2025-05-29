<?php

namespace App\Http\Resources;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->feedbacks()->avg('rate') % 1 == 0) {
            $avgRate = (int)$this->feedbacks()->avg('rate');
        } else {
            $avgRate = round($this->feedbacks()->avg('rate'), 2);
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'preview' => Photo::query()->where('room_id', $this->id)
                ->first(['id', 'link']),
            'photos' => Photo::query()->where('room_id', $this->id)
                ->get(['id', 'link']),
            'description' => $this->description,
            'amenities' => $this->amenities()
                ->select(['room_amenities.name', 'icon'])
                ->get()
                ->makeHidden('pivot'),
            'square' => $this->length * $this->width,
            'avg_rate' => $avgRate,
            'feedbacks' => $this->feedbacks()->count()
        ];
    }
}
