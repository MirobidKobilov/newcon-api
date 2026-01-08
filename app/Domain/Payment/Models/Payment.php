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
        'amount',
        'sale_id',
        'added_user_id',
        'company_id',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class , 'sale_id');
    }

    public function companies()
    {
        return $this->belongsTo(Company::class , 'company_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'added_user_id');
    }
}
