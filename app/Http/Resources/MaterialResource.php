<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
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
            'material_type' => new MaterialTypeResource($this->material_type),
            'name' => $this->name,
            'size' => $this->size,
            'quantity' => $this->quantity, 
        ];
    }
}
