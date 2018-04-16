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
        $troy = \App\User::create([
            'id' => 1,
            'name' => "Troy Pavlek",
            'email' => 'troy@tpavlek.me',
            'password' => Hash::make('green'),
            'twitter' => '@troypavlek',
            'facebook_connected' => true,
            'is_admin' => false,
        ]);

        $iveson = \App\User::create([
            'id' => 2,
            'name' => "Don Iveson",
            'email' => 'DonnyBoy@edmonton.ca',
            'password' => Hash::make('green'),
            'twitter' => '@doniveson',
            'is_admin' => true,
        ]);

        $opencity = \App\User::create([
            'id' => 3,
            'name' => "Edmonton Open City",
            'email' => 'opencity@limes.com',
            'password' => Hash::make('green'),
            'twitter' => '@opendataedm'
        ]);

        $cortland = \App\User::create([
            'name' => "Cortland Davidson",
            'email' => 'cort@limes.com',
            'password' => Hash::make('green'),
        ]);

        $anon_user = \App\AnonUser::create([
            'name' => "John Smith",
        ]);

        $hazeldean_buddy = Location::create([
            'id' => 1,
            'name' => 'Hazeldean Buddy Bench',
            'ref_uuid' => '97852f2b-5db2-4a0a-a3df-be0e44f48bb1',
            'img_path' => 'hazeldean-buddy-bench.jpg',
            'description' => "Installed in 2015 by the Hazeldean Community League, this buddy bench brings together community members and helps foster relationships with kids at Hazeldean School",
            'lat' => '53.5038189',
            'lon' => '-113.4769217'
        ]);

        \App\Post::create([
            'location_id' => $hazeldean_buddy->id,
            'author_id' => $iveson->id,
            'body' => "I'll totally admit that Hazeldean did buddy benches before us. Clearly their president is an absolute visionary",
            'img_url' => 'iveson-bench.png',
            'author_type' => get_class($iveson),
        ]);

        \App\Post::create([
            'location_id' => $hazeldean_buddy->id,
            'author_id' => $anon_user->id,
            'body' => "Definitely my favourite bench in the city",
            'author_type' => get_class($anon_user),
        ]);

        $city_hall = Location::create([
            'id' => 2,
            'name' => 'Edmonton City Hall',
            'ref_uuid' => 'a0a1d083-8822-4df6-a1bd-768621c72988',
            'img_path' => 'city-hall.jpg',
            'description' => "A place to talk to your councillors, meet other Edmontonians or enjoy one of the many events. According to new provincial regulation, it is now illegal to drown in the pool.",
            'lat' => '53.5438041',
            'lon' => '-113.4872443',
            'event_start' => '2018-04-16',
            'event_end' => '2018-04-17',
            'event_message' => "HealthHack at City Hall! Say hello here and don't lose the connections you made today!"
        ]);

        \App\Post::create([
            'location_id' => $city_hall->id,
            'author_id' => $opencity->id,
            'body' => "Wow! I'm so impressed with Troy's presentation that I'm just writing down 10/10 right now!",
            'author_type' => get_class($opencity),
        ]);

        $edm_buddy_bench = Location::create([
            'id' => 3,
            'name' => 'Edmonton Buddy Bench',
            'ref_uuid' => '6078d40e-3d80-45fe-9199-e4d7f20372ad',
            'img_path' => 'edm-buddy-bench.jpg',
            'description' => "Meet new people, reduce social isolation and most importantly: say hello!",
            'lat' => '53.5439054',
            'lon' => '-113.5019307',
        ]);
    }
}
