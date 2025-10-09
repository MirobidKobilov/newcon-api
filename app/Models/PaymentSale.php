<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSale extends Model
{
    protected $fillable = 
    [
        'payment_id',
        'sale_id',
        'amount',
    ];
}
