<?php

namespace App\Domain\WorkerSalary\Models;

use App\Domain\Worker\Models\Worker;
use Illuminate\Database\Eloquent\Model;

class WorkerSalary extends Model
{
    protected $fillable = 
    [
        'worker_id',
        'salary',
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class , 'worker_id');
    }
}
