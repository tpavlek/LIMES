<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class HomeController
{

    public function index()
    {
        $locations = Location::all()
            ->map(function($location){ return [$location->name, $location->lat, $location->lon];});

        return view('index')->with("locations", json_encode($locations));
    }

}
