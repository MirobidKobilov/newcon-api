<?php

namespace App\Domain\Worker\Models;

use App\Domain\WorkerSalary\Models\WorkerSalary;
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

    public function workerSalary()
    {
        return $this->hasMany(WorkerSalary::class , 'worker_id');
    }
}
