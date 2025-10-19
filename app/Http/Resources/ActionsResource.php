<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActionsResource extends JsonResource
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
            'action_type_id' => $this->action_type_id,
            'user' => new UserResource($this->user),
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
