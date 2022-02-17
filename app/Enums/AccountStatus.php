<?php

namespace App\Enums;

enum AccountStatus: int
{
    case Active = 1;
    case INACTIVE = 2;
    case INCOMPLETE = 3;
    case PENDING = 4;
}

