<?php

namespace App\Domain\Payment\Actions;

use App\Domain\Payment\Models\Payment;
use App\Http\Resources\PaymentResource;

class GetListPaymentsAction{

    public function __invoke()
    {
        $payments = Payment::paginate(10);
        return PaymentResource::collection($payments);
    }
}