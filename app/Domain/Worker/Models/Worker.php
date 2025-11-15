<?php

namespace App\Domain\Worker\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = 
    [
        'full_name',
        'phone',
        'position',
        'address',
        'date_of_birth',
        'salary',
        'status',
    ];
}
