<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $locations = Location::with('posts')->get();

        return view('admin.index')->with('locations', $locations);
    }

    public function showLocation($id)
    {
        $location = Location::findOrFail($id);

        return view('admin.show_location')
            ->with('location', $location);
    }
}
