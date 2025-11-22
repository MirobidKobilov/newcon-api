<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'company_id' => $this->company_id,
            'summa' => $this->summa,
            'products' => ProductResource::collection($this->products),
            'user' => $this->user,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
