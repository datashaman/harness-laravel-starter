<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Farewell;
use App\Infrastructure\Clock;
use App\Infrastructure\SystemClock;

final readonly class SayGoodbye
{
    public function __construct(private Clock $clock = new SystemClock) {}

    public function __invoke(string $name): string
    {
        return sprintf('[%s] %s', $this->clock->now()->format('c'), Farewell::for($name));
    }
}
