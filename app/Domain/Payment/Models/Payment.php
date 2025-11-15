<?php

namespace App\Domain\Payment\Models;

use App\Domain\Sale\Models\Sale;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable =
    [
        'name',
        'payment_type_id',
        'sales_stage',
        'uuid',
    ];

    public function sales()
    {
        return $this->belongsToMany(
            Sale::class,
            'payment_sales',
            'payment_id',
            'company_id'
        )->withPivot('amount');
    }
}
