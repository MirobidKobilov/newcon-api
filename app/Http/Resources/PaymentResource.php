<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'uuid' => $this->uuid,
            // 'sales' => SaleResource::collection($this->sales), 
            'companies' => $this->companies,
            'name' => $this->name,
            'payment_type_id' => $this->payment_type_id,
            'sales_stage' => $this->sales_stage,
        ];
    }
}
