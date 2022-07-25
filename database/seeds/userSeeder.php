<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use GuzzleHttp\Promise\Create;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for ($i = 1; $i <= 5; $i++) {
        //     User::create([
        //         'name' => 'user_' . $i,
        //         'email' => 'user_' . $i . '@user.com',
        //         'password' => bcrypt('www123456')
        //     ]);
        // }
        // factory(User::class, 4)->create();
        $users = [
            'waleed' => [
                'name' => 'waleed waleed',
                'email' => 'waleed@admin',
                'password' => bcrypt('www123456')
            ],
            'mariam' => [
                'name' => 'mariam mariam',
                'email' => 'mariam@user',
                'password' => bcrypt('www123456')
            ],
        ];
        foreach ($users as $user => $data) {
            User::create($data);
        }
    }
}