<?php

namespace Wepa\BroadcastSchedule\Commands;

use Illuminate\Console\Command;
use Wepa\BroadcastSchedule\Database\Seeders\DefaultSeeder;

class BroadcastScheduleInstallCommand extends Command
{
    public $signature = 'broadcast-schedule:install';

    public $description = 'Install data';

    public function handle(): int
    {
        $this->call('db:seed', ['class' => DefaultSeeder::class]);

        return self::SUCCESS;
    }
}
