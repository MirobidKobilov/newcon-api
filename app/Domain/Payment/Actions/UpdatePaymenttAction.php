<?php


namespace App\Domain\Payment\Actions;

use App\Domain\Payment\Models\Payment;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;

class UpdatePaymenttAction
{
    public function __invoke(Request $request, $id)
    {
        $validated = $request->validate([
            'sales_stage' => 'nullable|string'
        ]);

        $payment = Payment::findOrFail($id);

        $payment->update($validated);

        return new PaymentResource($payment);
    }
}
