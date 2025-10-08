<?php

namespace App\Domain\Material\Models;

use App\Domain\MaterialType\Models\MaterialType;
use Illuminate\Database\Eloquent\Model;

class Material extends Model

{
    protected $fillable = 
    [
        'name',
        'material_type_id',
        'size',
        'quantity',
    ];

    public function material_type()
    {
        return $this->belongsTo(MaterialType::class);
    }
}
