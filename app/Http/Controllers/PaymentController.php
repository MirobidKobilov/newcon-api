<?php

namespace App\Http\Controllers;

use App\Domain\Payment\Actions\CreatePaymentAction;
use App\Domain\Payment\Actions\GetListPaymentsAction;
use App\Domain\Payment\Actions\UpdatePaymenttAction;
use App\Http\Requests\CreatePaymentRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    
    protected $payment_list;
    protected $create_payment;
    protected $update_payment;

    public function __construct(GetListPaymentsAction $payment_list , CreatePaymentAction $create_payment , UpdatePaymenttAction $update_payment)
    {
        $this->payment_list = $payment_list;
        $this->create_payment = $create_payment;
        $this->update_payment = $update_payment;
    }

    public function index(Request $request)
    {
        return ($this->payment_list)($request);
    }

    public function create(CreatePaymentRequest $request)
    {
        return ($this->create_payment)($request);
    }

    public function update(Request $request , $id)
    {
        return ($this->update_payment)($request , $id);
    }
}
