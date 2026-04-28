<?php

declare(strict_types=1);

namespace App\Domain;

use InvalidArgumentException;

final class Farewell
{
    public static function for(string $name): string
    {
        if ($name === '') {
            throw new InvalidArgumentException('name is required');
        }

        return "Goodbye, {$name}.";
    }
}
