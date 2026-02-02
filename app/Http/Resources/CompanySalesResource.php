<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanySalesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'deposit' => $this->deposit,
            'total_payments' => $this->total_payments ?? 0,
            'sales' => SingleSaleResource::collection($this->sales),
            'payments' => PaymentResource::collection($this->payments),
        ];
    }
}