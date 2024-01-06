<?php

namespace App\Infrastructure\Database\Trait;

/**
 * Trait for extraction class name in human-readable format
 */
trait ClassNameExtractor
{
    public static function extractClassName(): string
    {
        $path = \explode('\\', static::class);
        return \trim(\implode(' ', \preg_split('/(?=[A-Z])/', \array_pop($path))));
    }
}
