<?php

namespace App\Domain\Sale\Models;

use App\Domain\Company\Models\Company;
use App\Domain\Payment\Models\Payment;
use App\Domain\Product\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable =
    [
        'company_id',
        'summa',
        'added_user_id',
        'status',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'added_user_id');
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_sales',
            'sale_id',
            'product_id'
        )->withPivot('quantity' , 'sales_type_id' , 'price');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class , 'sale_id');
    }

}
