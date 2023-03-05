<?php

namespace Wepa\BroadcastSchedule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Wepa\BroadcastSchedule\Models\Calendar;
use Wepa\BroadcastSchedule\Models\Program;

class DemoSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Program::truncate();
        Calendar::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Program::factory()->count(10)->create();
        Calendar::factory()->count(10)->create(['day' => 'monday']);
        Calendar::factory()->count(10)->create(['day' => 'tuesday']);
        Calendar::factory()->count(10)->create(['day' => 'wednesday']);
        Calendar::factory()->count(10)->create(['day' => 'thursday']);
        Calendar::factory()->count(10)->create(['day' => 'friday']);
        Calendar::factory()->count(10)->create(['day' => 'saturday']);
        Calendar::factory()->count(10)->create(['day' => 'sunday']);
    }
}
