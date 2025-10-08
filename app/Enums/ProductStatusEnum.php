<?php

namespace App\Enums;

enum ProductStatusEnum
{
    const ACTIVE = 1;
    const INACTIVE = 0;

    public function label() : int
    {
        return match($this){
            self::ACTIVE => 1,
            self::INACTIVE => 0
        };
    }
}
