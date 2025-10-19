<?php

namespace App\Domain\Payment\Actions;

use App\Domain\Payment\Models\Payment;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;

class GetListPaymentsAction
{

    public function __invoke(Request $request)
    {
        $validate = $request->validate([
            'pagination' => 'nullable|integer',
        ]);

        $page = $validate['pagination'] ?? 10;
        
        $payments = Payment::with(['sales'])->paginate($page);
        return PaymentResource::collection($payments);
    }
}
