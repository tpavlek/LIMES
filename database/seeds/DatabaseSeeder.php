<?php

use App\Location;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'name' => "Troy Pavlek",
            'email' => 'troy@tpavlek.me',
            'password' => 'green',
            'snapchat' => 'snapchat!handle',
            'twitter' => '@twitter!handle'
        ]);

        \App\User::create([
            'name' => "Cort davidson",
            'email' => 'cortland.davidson@not.com',
            'password' => 'blue',
            'snapchat' => 'snapchat!handle',
            'twitter' => '@twitter!handle'
        ]);

        \App\User::create([
            'name' => "Mr baby",
            'email' => 'iamacat@cat.com',
            'password' => 'red',
            'snapchat' => 'snapchat!handle',
            'twitter' => '@twitter!handle'
        ]);

        $anon_user = \App\AnonUser::create([
            'name' => "Mike Nickel",
        ]);

        $location = Location::build('Hazeldean Buddy Bench', [
            'id' => 1,
            'img_path' => '/hazeldean-buddy-bench.jpg',
            'description' => "Installed in 2015, this buddy bench brings together Edmontonians in the community for fun times"
        ]);

        \App\Post::create([
            'location_id' => $location->id,
            'author_id' => $user->id,
            'body' => "I really like this buddy bench because it's all rainbow and cool WOW I LOVE COKE!",
            'img_url' => 'astley.jpg',
            'author_type' => get_class($user),
        ]);

        \App\Post::create([
            'location_id' => $location->id,
            'author_id' => $anon_user->id,
            'body' => "I don't like buddy benches because I like money",
            'author_type' => get_class($anon_user),
        ]);
    }
}
