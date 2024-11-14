<?php

namespace Rmsramos\Activitylog;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ActivitylogServiceProvider extends PackageServiceProvider
{
    public static string $name = 'activitylog';

    public function configurePackage(Package $package): void
    {
        $package
            ->name('activitylog')
            ->hasConfigFile('filament-activitylog')
            ->hasViews('activitylog')
            ->hasTranslations()
            ->hasInstallCommand(function (InstallCommand $installCommand) {
                $installCommand
                    ->publishConfigFile()
                    ->askToStarRepoOnGitHub('rmsramos/activitylog')
                    ->startWith(function (InstallCommand $installCommand) {
                        $installCommand->call('vendor:publish', [
                            '--provider' => "Spatie\Activitylog\ActivitylogServiceProvider",
                            '--tag'      => 'activitylog-migrations',
                        ]);
                    });
            });
    }
}
