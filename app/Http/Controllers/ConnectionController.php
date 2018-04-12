<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Connection;

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
        $connection = new Connection();
        //placeholder for testing TODO:Remove
        $connection->owner_id = 1;
        //$connection->owner_id = Auth::user()->id;
        $connection->user_id = $id;

        if(count(Connection::where('owner_id', $connection->owner_id)->where('user_id', $connection->user_id)->get()) > 0)
        {
            abort(200, 'Already connected with this user.');
        }

        $connection->save();
        return view('users.connected')
            ->with('connection', $connection);
    }

}
