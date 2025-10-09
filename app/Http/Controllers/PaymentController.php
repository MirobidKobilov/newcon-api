<?php

namespace App\Http\Controllers;

use App\Domain\Payment\Actions\CreatePaymentAction;
use App\Domain\Payment\Actions\GetListPaymentsAction;
use App\Http\Requests\CreatePaymentRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    
    protected $payment_list;
    protected $create_payment;

    public function __construct(GetListPaymentsAction $payment_list , CreatePaymentAction $create_payment)
    {
        $this->payment_list = $payment_list;
        $this->create_payment = $create_payment;
    }

    public function index()
    {
        return ($this->payment_list)();
    }

    public function create(CreatePaymentRequest $request)
    {
        return ($this->create_payment)($request);
    }
}
