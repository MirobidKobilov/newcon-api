<?php

namespace App\Domain\Payment\Actions;

use App\Domain\Company\Models\Company;
use App\Domain\Payment\Models\Payment;
use App\Http\Requests\CreatePaymentRequest;
use App\Http\Resources\PaymentResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreatePaymentAction
{
    public function execute(CreatePaymentRequest $request)
    {
        $data = $request->validated();

        return DB::transaction(function () use ($data) {

            do {
                $uuid = random_int(100000, 999999);
            } while (Payment::where('uuid', $uuid)->exists());

            $payment = Payment::create([
                'name' => $data['name'],
                'payment_type_id' => $data['payment_type_id'],
                'sales_stage' => 'payed',
                'uuid' => $uuid,
                'added_user_id' => Auth::id(),
                'amount' => $data['amount'],
                'sale_id' => $data['sale_id'] ?? null,
            ]);

            $companyPivotData = [];

            if (isset($data['sales']) && is_array($data['sales'])) {
                foreach ($data['sales'] as $item) {

                    if (!isset($item['company_id'], $item['amount'])) {
                        continue;
                    }

                    $company = Company::lockForUpdate()->findOrFail($item['company_id']);

                    $company->payment += $item['amount'];
                    $company->debt -= $item['amount'];
                    $company->deposit += $item['amount'];
                    $company->save();

                    $companyPivotData[$item['company_id']] = [
                        'amount' => $item['amount']
                    ];
                }

                if (!empty($companyPivotData)) {
                    $payment->companies()->attach($companyPivotData);
                }
            }


            $payment->companies()->attach($companyPivotData);

            return new PaymentResource($payment);
        });
    }
}
