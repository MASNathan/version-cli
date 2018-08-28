<?php

namespace App\Providers;

use App\Version;
use App\VersionList;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(VersionList::class, function () {
            $versionsList = new VersionList();

            $versionsList = $versionsList->merge($this->getGitVersions());

            return $versionsList
                ->map(function ($path) {
                    return new Version(basename($path));
                })
                ->sort(function (Version $a, Version $b) {
                    return version_compare($a, $b);
                });
        });
    }

    protected function getGitVersions(): VersionList
    {
        $gitPath = getcwd() . DIRECTORY_SEPARATOR . '.git/refs/tags/';

        if (!is_dir($gitPath)) {
            return new VersionList();
        }

        return VersionList::make(glob($gitPath . '*'));
    }
}
