<?php

namespace App\Models;

use App\Domain\Product\Models\Product;
use App\Domain\Sale\Models\Sale;
use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    protected $fillable = 
    [
        'sale_id',
        'product_id',
        'quantity',
    ];

}
