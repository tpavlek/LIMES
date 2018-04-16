<?php

namespace App\Http\Controllers;

use App\Location;

class TagController extends Controller
{

    public function redirectUuid($uuid)
    {
        $location = Location::findUuid($uuid);

        return redirect()->route('location', $location->id);
    }

}
