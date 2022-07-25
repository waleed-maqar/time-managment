<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\User;
use App\Models\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    $users = User::pluck('id')->toArray();
    $per = ['low', 'normal', 'high'];
    $now = now()->format('Y-m-d');
    $times = [];
    for ($i = 8; $i <= 20; $i++) {
        $times[] = "$now $i:" . rand(0, 59);
    }
    return [
        'title' => $faker->name,
        'description' => $faker->paragraph(4),
        'periority' => $faker->randomElement($per),
        'user_id' => $faker->randomElement($users),
        'start_date' => $faker->dateTimeBetween('-5days', '+5days'),
        'end_date' => $faker->dateTimeBetween('-5days', '+5days'),
        // 'start_date' => $faker->randomElement($times),
        // 'end_date' => $faker->randomElement($times),
    ];
});