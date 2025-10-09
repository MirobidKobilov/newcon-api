<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionType extends Model
{
    public const USER_CREATED = 1;
    public const USER_UPDATED = 2;
    public const USER_DELETED = 3;
    public const USER_RESTORED = 4;
    public const USER_FORCE_DELETED = 5;

    public const PRODUCT_CREATED = 6;
    public const PRODUCT_UPDATED = 7;
    public const PRODUCT_DELETED = 8;
    public const PRODUCT_RESTORED = 9;
    public const PRODUCT_FORCE_DELETED = 10;

    public const MATERIAL_CREATED = 11;
    public const MATERIAL_UPDATED = 12;
    public const MATERIAL_DELETED = 13;
}
