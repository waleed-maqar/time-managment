<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Step;
use App\Models\Task;
use Faker\Generator as Faker;

$factory->define(Step::class, function (Faker $faker) {
    $tasks = Task::pluck('id')->toArray();
    return [
        'step' => $faker->name,
        'task_id' => $faker->randomElement($tasks),
    ];
});