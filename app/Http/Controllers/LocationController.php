<?php

namespace App\Http\Controllers;

use App\Location;

class LocationController extends Controller
{

    public function show($id)
    {
        $location = Location::with('posts')->findOrFail($id);

        return view('location.show')->with('location', $location);
    }

}
