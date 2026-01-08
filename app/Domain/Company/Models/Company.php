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
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'company_id');
    }
}
