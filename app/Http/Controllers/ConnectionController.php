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
        $connection = new Connection();

        $connection->owner_id = Auth::user()->id;
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
