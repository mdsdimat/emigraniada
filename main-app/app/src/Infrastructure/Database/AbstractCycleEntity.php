<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use App\Infrastructure\Database\Trait\TsTrait;
use App\Infrastructure\Database\Trait\ClassNameExtractor;

abstract class AbstractCycleEntity
{
    use TsTrait;
    use ClassNameExtractor;
}
