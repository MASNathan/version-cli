<?php

namespace App\Commands;

use App\Version;
use App\VersionList;
use LaravelZero\Framework\Commands\Command;

class CurrentCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'current
                            {--file= : File with current version string}\'';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Show Version';

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

        $this->line((string)$this->versionList->last());
    }
}
