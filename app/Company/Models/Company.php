<?php

namespace App\Company\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = 
    [
        'name',
        'phone',
        'address',
    ];
}
