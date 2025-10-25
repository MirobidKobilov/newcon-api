<?php

namespace App\Domain\Sale\Models;

use App\Domain\Company\Models\Company;
use App\Domain\Payment\Models\Payment;
use App\Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable =
    [
        'company_id',
        'summa',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_sales',
            'sale_id',
            'product_id'
        )->withPivot('quantity' , 'sales_type_id');
    }

    public function payments()
    {
        return $this->belongsToMany(
            Payment::class,
            'payment_sales',
            'sale_id',
            'payment_id'
        )->withPivot('amount');
    }
}
