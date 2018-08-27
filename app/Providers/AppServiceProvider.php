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
            $gitPath = getcwd() . DIRECTORY_SEPARATOR . '.git/refs/tags/';

            // for now we only support git

            if (!is_dir($gitPath)) {
                throw new \Exception("GIT tags directory not found!");
            }

            return VersionList::make(glob($gitPath . '*'))
                ->map(function ($path) {
                    return new Version(basename($path));
                })
                ->sort(function (Version $a, Version $b) {
                    return version_compare($a, $b);
                });
        });
    }
}
