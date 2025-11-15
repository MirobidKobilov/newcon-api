<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkerResource extends JsonResource
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
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'position' => $this->position,
            'address' => $this->address,
            'date_of_birth' => $this->date_of_birth,
            'salary' => $this->salary,
            'status' => $this->status,
        ];
    }
}
