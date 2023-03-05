<?php

namespace Wepa\BroadcastSchedule\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Wepa\BroadcastSchedule\Models\Calendar;
use Wepa\BroadcastSchedule\Models\Program;

class CalendarFactory extends Factory
{
    protected $model = Calendar::class;

    public function definition()
    {
        $program = Program::inRandomOrder()->first();

        if ($program) {
            return [
                'program_id' => $program->id,
                'day' => $this->faker->dayOfWeek,
                'time' => $this->faker->time,
            ];
        }
    }
}
