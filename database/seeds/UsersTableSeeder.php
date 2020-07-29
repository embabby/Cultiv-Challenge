<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        //ToCreateAdmin
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        //ToCreateNormalUser
        $normal_user = User::create([
            'name' => 'NormalUser',
            'email' => 'user@test.com',
            'password' => Hash::make('123456'),
        ]);


        // And now let's generate a few randoms users:
        $faker = Faker::create();
		$password = Hash::make('secret');

        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name'     => $faker->name,
                'email'    => $faker->email,
                'password' => $password,
            ]);
        }
    }
}
