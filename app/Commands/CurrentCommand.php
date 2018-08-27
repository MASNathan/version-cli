<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;

class CurrentCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'current';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Get Current Version';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
    }
}
