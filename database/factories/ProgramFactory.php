<?php

namespace Wepa\BroadcastSchedule\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Wepa\BroadcastSchedule\Models\Program;

class ProgramFactory extends Factory
{
    protected $model = Program::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl,
        ];
    }
}
