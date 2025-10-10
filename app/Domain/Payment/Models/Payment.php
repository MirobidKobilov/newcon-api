<?php

namespace App\Domain\Payment\Models;

use App\Domain\Sale\Models\Sale;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable =
    [
        'opportunity_id',
        'name',
        'payment_type_id',
        'sales_stage',
    ];

    public function sales()
    {
        return $this->belongsToMany(
            Sale::class,
            'payment_sales',
            'payment_id',
            'sale_id'
        )->withPivot('amount');
    }
}
