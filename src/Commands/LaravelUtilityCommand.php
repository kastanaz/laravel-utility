<?php

namespace Kastanaz\LaravelUtility\Commands;

use Illuminate\Console\Command;

class LaravelUtilityCommand extends Command
{
    public $signature = 'laravel-utility';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
