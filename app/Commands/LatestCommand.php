<?php

namespace App\Commands;

use App\VersionList;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class LatestCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'latest';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Get latest version';

    /**
     * @var VersionList
     */
    protected $versionList;

    public function __construct(VersionList $versionList)
    {
        parent::__construct();

        $this->versionList = $versionList;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        dd((string)$this->versionList->last());
        $this->info((string)$this->versionList->last());
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
