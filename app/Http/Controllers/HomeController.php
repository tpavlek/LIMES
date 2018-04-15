<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class HomeController
{

    public function index()
    {
        $locations = Location::all()->shuffle();

        $json_locations = $locations->map(function ($location) {
            return [ $location->name, $location->lat, $location->lon ];
        })->toJson();

        return view('index')
            ->with("json_locations", $json_locations)
            ->with('locations', $locations);
    }

    public function profile()
    {
        return view('profile')->with('user', \Auth::user());
    }

}
