<?php

namespace Wepa\BroadcastSchedule\Commands;

use Illuminate\Console\Command;
use Wepa\BroadcastSchedule\Database\Seeders\DemoSeeder;

class BroadcastScheduleDemoCommand extends Command
{
    public $signature = 'broadcast-schedule:demo';

    public $description = 'Install demo data';

    public function handle(): int
    {
        $this->call('db:seed', ['class' => DemoSeeder::class]);

        return self::SUCCESS;
    }
}
