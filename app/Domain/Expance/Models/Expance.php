<?php

namespace App\Domain\Expance\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Expance extends Model
{
    protected $fillable = 
    [
        'user_id',
        'amount',
        'reason',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
