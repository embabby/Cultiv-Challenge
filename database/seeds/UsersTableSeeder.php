<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;
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


        // And now let's generate a few posts belongs to this normal user:
        $faker = Faker::create();

        for ($i = 0; $i < 4; $i++) {
            Post::create([
                'title' => $faker->name,
                'body' => $faker->text,
                'user_id' => $normal_user->id,
            ]);
        }
    }
}
