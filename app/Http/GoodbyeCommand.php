<?php

declare(strict_types=1);

namespace App\Http;

use App\Application\SayGoodbye;
use Illuminate\Console\Command;

final class GoodbyeCommand extends Command
{
    protected $signature = 'app:goodbye {name=world}';

    protected $description = 'Print a timestamped farewell.';

    public function handle(SayGoodbye $sayGoodbye): int
    {
        /** @var string $name */
        $name = $this->argument('name');
        $this->line($sayGoodbye($name));

        return self::SUCCESS;
    }
}
