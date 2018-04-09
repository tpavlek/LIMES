<?php

namespace App\Http\Controllers;

use App\Location;

class LocationController extends Controller
{

    public function show($id)
    {
        //$location = Location::with('posts')->findOrFail($id);

        $location = new Location([
            'name' => 'Hazeldean Buddy Bench',
            'img_path' => '/hazeldean-buddy-bench.jpg',
            'description' => "Installed in 2015, this buddy bench brings together Edmontonians in the community for fun times"
        ]);

        return view('location.show')->with('location', $location);
    }

}
