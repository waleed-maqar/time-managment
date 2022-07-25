<?php

use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(userSeeder::class);
        $this->call(TaskSeeder::class);
        // $this->call(StepSeeder::class);
    }
}