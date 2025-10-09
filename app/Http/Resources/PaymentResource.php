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
            'opportunity_id' => $this->opportunity,
            'sales' => new SaleResource($this->sales), 
            'name' => $this->name,
            'amount' => $this->amount,
            'payment_type_id' => $this->payment_type_id,
            'sales_stage' => $this->sales_stage,
        ];
    }
}
