<?php

namespace Wepa\BroadcastSchedule\Database\Seeders;

use Illuminate\Database\Seeder;
use Wepa\Core\Models\Menu;

class DefaultSeeder extends Seeder
{
    public function run()
    {
        Menu::loadPackageItems('broadcast-schedule');
    }
}
