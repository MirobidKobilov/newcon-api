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
        $paidAmount = (float) ($this->paid_amount ?? 0);
        $debt = (float) ($this->debt ?? 0);
        $deposit = $paidAmount - $debt;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'paid_amount' => $paidAmount,
            'debt' => $debt,
            'deposit' => $deposit,
            'sales' => SaleResource::collection($this->sales),
            'payments' => PaymentResource::collection($this->payments),
        ];
    }
}