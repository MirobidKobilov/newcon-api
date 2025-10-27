<?php

namespace App\Domain\Payment\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSale extends Model
{
    protected $fillable = 
    [
        'payment_id',
        'sale_id',
        'sale_type_id',
        'amount',
    ];
}
