<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Factory as Faker;


class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Post::truncate();
        \App\Post::unguard();

        $faker = Faker::create();

        \App\User::where('role','user')->get()->each(function ($user) use ($faker) {
            foreach (range(1, 5) as $i) {
                \App\Post::create([
                    'user_id' => $user->id,
                    'title'   => $faker->sentence,
                    'body' => $faker->paragraphs(3, true),
                ]);
            }
        });
    }
}
