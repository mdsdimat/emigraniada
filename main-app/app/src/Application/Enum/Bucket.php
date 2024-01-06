<?php

declare(strict_types=1);

namespace App\Application\Enum;

enum Bucket: string
{
    /**
     * Default bucket located on AWS
     */
    case Aws = 'aws';

    /**
     * Bucket for local tm uploadings
     */
    case Tmp = 'tmp';
}
