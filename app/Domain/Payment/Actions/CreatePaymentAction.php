<?php
namespace App\Domain\Payment\Actions;

use App\Domain\Payment\Models\Payment;
use App\Http\Requests\CreatePaymentRequest;
use App\Http\Resources\PaymentResource;

class CreatePaymentAction
{
    public function __invoke(CreatePaymentRequest $request)
    {
        $data = $request->validated();
        
        $payment = Payment::create([
            'opportunity_id' => $data['opportunity_id'],
            'name' => $data['name'],
            'payment_type_id' => $data['payment_type_id'],
            'sales_stage' => $data['sales_stage'],
        ]);

        foreach ($data['sales'] as $sale) {
            $payment->sales()->attach($sale['sale_id'], [
                'amount' => $sale['amount'],
            ]);
        }

        return new PaymentResource($payment);
    }
}

?>