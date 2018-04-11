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
        $location = Location::build('Hazeldean Buddy Bench', [
            'id' => 1,
            'img_path' => '/hazeldean-buddy-bench.jpg',
            'description' => "Installed in 2015, this buddy bench brings together Edmontonians in the community for fun times"
        ]);
    }
}
