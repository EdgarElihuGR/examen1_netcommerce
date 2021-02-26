<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'start_date' => $this->faker->dateTimeThisMonth($max = 'now', $timezone = null),
            'end_date' => $this->faker->dateTimeThisMonth($max = 'now', $timezone = null),
            'creator_user_id' => rand(1,5),
            'assigned_user_id' => rand(1,5),
        ];
    }
}
