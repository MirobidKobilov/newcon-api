<?php

namespace App\Domain\Company\Models;

use App\Domain\Payment\Models\Payment;
use App\Domain\Sale\Models\Sale;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable =
    [
        'name',
        'phone',
        'address',
        'deposit',
        'debt',
        'payment',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function payments()
    {
        return $this->belongsToMany(
            Payment::class,
            'payment_sales',
            'company_id',
            'payment_id'
        )->withPivot('amount');
    }
}
