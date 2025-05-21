<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'room_id' => $this->room_id,
            'user_id' => $this->user_id,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'pets' => $this->whenLoaded('pets')->pluck('id')->toArray(),
            'approved' => $this->approved
        ];
    }
}
