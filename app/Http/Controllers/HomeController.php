<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController
{

    public function index()
    {
        return view('index');
    }

    public function login(Request $request)
    {
        if ($request->get('return_to')) {
            \Session::put('return_to', $request->get('return_to'));
        }

        return view('account.login');
    }

}
