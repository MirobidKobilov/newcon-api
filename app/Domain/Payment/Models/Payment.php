<?php

namespace App\Domain\Payment\Models;

use App\Domain\Company\Models\Company;
use App\Domain\Sale\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable =
    [
        'name',
        'payment_type_id',
        'sales_stage',
        'uuid',
        'added_user_id'
    ];

    public function companies()
    {
        return $this->belongsToMany(
            Company::class,
            'payment_sales',
            'payment_id',
            'company_id'
        )->withPivot('amount');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'added_user_id');
    }
}
