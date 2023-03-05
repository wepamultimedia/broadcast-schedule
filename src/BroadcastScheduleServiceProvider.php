<?php

namespace Wepa\BroadcastSchedule;

use Database\Seeders\DatabaseSeeder;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Wepa\BroadcastSchedule\Commands\BroadcastScheduleDemoCommand;
use Wepa\BroadcastSchedule\Commands\BroadcastScheduleInstallCommand;
use Wepa\BroadcastSchedule\Commands\BroadcastScheduleSymLinkCommand;
use Wepa\BroadcastSchedule\Database\Seeders\DefaultSeeder;

class BroadcastScheduleServiceProvider extends PackageServiceProvider
{
    public function bootingPackage()
    {
        $this->hasSeeders([DefaultSeeder::class]);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'broadcast-schedule-migrations');

        // Pages
        $this->publishes([
            __DIR__.'/../resources/js/Pages' => resource_path('js/Pages/Vendor/BroadcastSchedule'),
        ], ['broadcast-schedule', 'broadcast-schedule-pages']);

        // Components
        $this->publishes([
            __DIR__.'/../resources/js/Components' => resource_path('js/Vendor/BroadcastSchedule'),
        ], ['broadcast-schedule', 'broadcast-schedule-components']);

        $this->publishes([
            __DIR__.'/../tests/Unit' => base_path('tests/Unit/BradcastSchedule'),
            __DIR__.'/../tests/Feature' => base_path('tests/Feature/BradcastSchedule'),
        ], ['broadcast-schedule-tests']);
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('broadcast-schedule')
            ->hasConfigFile()
            ->hasRoutes(['api', 'web', 'admin'])
            ->hasTranslations()
            ->hasCommands([
                BroadcastScheduleSymLinkCommand::class,
                BroadcastScheduleDemoCommand::class,
                BroadcastScheduleInstallCommand::class,
            ]);
    }

    protected function hasSeeders(array $seeders): void
    {
        $this->callAfterResolving(DatabaseSeeder::class,
            function ($cb) use ($seeders) {
                $cb->call($seeders);
            });
    }
}
