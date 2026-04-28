<?php

declare(strict_types=1);

use App\Application\SayGoodbye;
use App\Infrastructure\Clock;

beforeEach(function (): void {
    $this->fixedClock = new class implements Clock
    {
        public function now(): DateTimeImmutable
        {
            return new DateTimeImmutable('2026-04-28T12:00:00+00:00');
        }
    };
});

it('prefixes the farewell with the clock timestamp', function (): void {
    $sayGoodbye = new SayGoodbye($this->fixedClock);
    expect($sayGoodbye('Ada'))->toBe('[2026-04-28T12:00:00+00:00] Goodbye, Ada.');
});

it('propagates name validation from the domain', function (): void {
    $sayGoodbye = new SayGoodbye($this->fixedClock);
    expect(fn (): string => $sayGoodbye(''))->toThrow(InvalidArgumentException::class, 'name is required');
});
