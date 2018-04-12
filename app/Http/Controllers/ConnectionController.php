<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Connection;
use Illuminate\Support\Facades\Auth;

class ConnectionController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $connections = Connection::getAvailableConnections($user);

        return view('users.connections')
            ->with('user', $user)
            ->with('connections', $connections);
    }

    public function add($id)
    {
        $to_user = User::findOrFail($id);

        $connection = Connection::connect(Auth::user(), $to_user);

        if(!Auth::user()->hasAlreadyConnectedWith($to_user))
        {
            $connection->save();
        }

        return view('users.connected')
            ->with('connection', $connection)
            ->with('user_name', $to_user->name);
    }

}
