<?php
namespace App\Domain\Payment\Actions;

use App\Domain\Payment\Models\Payment;
use App\Http\Requests\CreatePaymentRequest;
use App\Http\Resources\PaymentResource;
use Illuminate\Support\Facades\DB;

class CreatePaymentAction
{
    public function __invoke(CreatePaymentRequest $request)
    {
        $data = $request->validated();
        
        return DB::transaction(function () use ($data) {
            do {
                $uuid = random_int(100000, 999999);
            } while (Payment::where('uuid', $uuid)->exists());
            
            $payment = Payment::create([
                'name' => $data['name'],
                'payment_type_id' => $data['payment_type_id'],
                'sales_stage' => $data['sales_stage'],
                'uuid' => $uuid,
            ]);
            
            $companyData = [];
            foreach ($data['sales'] as $item) {
                $companyData[$item['company_id']] = [
                    'amount' => $item['amount']
                ];
            }
            
            $payment->companies()->attach($companyData);
            
            $payment->load('companies');
            
            return new PaymentResource($payment);
        });
    }
}