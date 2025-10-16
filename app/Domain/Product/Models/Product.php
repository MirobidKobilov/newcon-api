<?php

namespace App\Domain\Product\Models;

use App\Domain\Sale\Models\Sale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable =
    [
        'name',
        'description',
        'quantity',
        'status',
        'image',
    ];

    public function sales()
    {
        return $this->belongsToMany(
            Sale::class,
            'product_sales',   
            'product_id',      
            'sale_id'          
        )->withPivot('quantity')
            ->withTimestamps();
    }
}
