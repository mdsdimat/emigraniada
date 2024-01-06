<?php

declare(strict_types=1);

namespace App\Application\Enum;

enum HttpStatus: int
{
    case Ok = 200;
    case BadRequest = 400;
}
