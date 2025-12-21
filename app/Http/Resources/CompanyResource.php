<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'deposit' => $this->deposit,
            'debt' => $this->debt,
            'payment' => $this->payment,
            'total_payments' => $this->total_payments,
            'sales' => SaleResource::collection($this->sales),
            'payments' => PaymentResource::collection($this->payments),
        ];
    }
}
