<?php

namespace App\Commands;

use App\Version;
use App\VersionList;
use LaravelZero\Framework\Commands\Command;

class IncrementCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'increment
                            {version : Value to increment version with}
                            {--file= : File with current version string}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Increments current version with a given value';

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
        if ($this->hasOption('file') && $this->option('file')) {
            $version = trim(file_get_contents(getcwd() . DIRECTORY_SEPARATOR . $this->option('file')));
            $this->versionList = VersionList::make([new Version($version)]);
        }

        $this->info((string)$this->versionList->last()->increment($this->argument('version')));
    }
}
