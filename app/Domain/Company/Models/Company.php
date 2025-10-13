<?php

namespace App\Domain\Company\Models;

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
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
