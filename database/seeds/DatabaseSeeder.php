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
            'password' => Hash::make('green'),
            'snapchat' => 'snapchat!handle',
            'twitter' => '@twitter!handle',
            'facebook_connected' => true,
            'is_admin' => true,
        ]);

        \App\User::create([
            'name' => "Cort davidson",
            'email' => 'cort@limes.com',
            'password' => Hash::make('green'),
            'snapchat' => 'snapchat!handle',
            'twitter' => '@twitter!handle'
        ]);

        $mrBaby = \App\User::create([
            'name' => "Mr baby",
            'email' => 'cat@limes.com',
            'password' => Hash::make('green'),
            'snapchat' => 'snapchat!handle',
            'twitter' => '@twitter!handle'
        ]);

        $anon_user = \App\AnonUser::create([
            'name' => "John Smith",
        ]);

        $hazeldean_buddy = Location::create([
            'id' => 1,
            'name' => 'Hazeldean Buddy Bench',
            'ref_uuid' => '97852f2b-5db2-4a0a-a3df-be0e44f48bb1',
            'img_path' => 'hazeldean-buddy-bench.jpg',
            'description' => "Installed in 2015, this buddy bench brings together Edmontonians in the community for fun times",
            'lat' => '53.5038189',
            'lon' => '-113.4769217'
        ]);

        \App\Post::create([
            'location_id' => $hazeldean_buddy->id,
            'author_id' => $user->id,
            'body' => "I really like this buddy bench because it's all rainbow and cool WOW I LOVE COKE!",
            'img_url' => 'astley.jpg',
            'author_type' => get_class($user),
        ]);

        \App\Post::create([
            'location_id' => $hazeldean_buddy->id,
            'author_id' => $mrBaby->id,
            'body' => "I'm a cat where is the catnip",
            'author_type' => get_class($mrBaby),
        ]);

        \App\Post::create([
            'location_id' => $hazeldean_buddy->id,
            'author_id' => $anon_user->id,
            'body' => "I value my privacy, friends",
            'author_type' => get_class($anon_user),
        ]);
    }
}
