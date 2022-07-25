<?php

use App\Models\Step;
use Faker\Factory;
use Illuminate\Database\Seeder;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Factory(Step::class, 100)->create();
    }
}