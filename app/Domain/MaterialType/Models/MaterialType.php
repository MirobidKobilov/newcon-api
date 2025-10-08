<?php

namespace App\Domain\MaterialType\Models;

use App\Domain\Material\Models\Material;
use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    protected $fillable =
    [
        'name',
    ];

    public function material()
    {
        return $this->hasMany(Material::class);
    }
}
