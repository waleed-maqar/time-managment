<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $per = ['low', 'normal', 'high'];
        /*
        $now = now()->format('Y-m-d');
        $times = [];
        for ($i = 8; $i <= 20; $i++) {
            $times[] = "$now $i:" . rand(0, 59);
        }
        */
        return [
            'title' => $this->faker->name,
            'description' => $this->faker->paragraph(4),
            'periority' => $this->faker->randomElement($per),
            'user_id' => $this->faker->randomElement($users),
            'start_date' => $this->faker->dateTimeBetween('-5days', '+5days'),
            'end_date' => $this->faker->dateTimeBetween('-5days', '+5days'),
            /*
            'start_date' => $faker->randomElement($times),
            'end_date' => $faker->randomElement($times),
            */
        ];
    }
}