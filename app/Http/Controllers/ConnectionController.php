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
        $incoming = Connection::getIncomingConnections($user);
        $outgoing = Connection::getOutgoingConnections($user);

        return view('users.connections')
            ->with('user', $user)
            ->with('incoming', $incoming)
            ->with('outgoing', $outgoing);
    }

    public function add($id)
    {
        $to_user = User::findOrFail($id);
        $user = Auth::user();

        if($user == null)
        {
            return(redirect()->route('login'));
        }

        $connection = Connection::connect(Auth::user(), $to_user);

        if(!Auth::user()->hasAlreadyConnectedWith($to_user))
        {
            $connection->save();
        }

        return view('users.connected')
            ->with('connection', $connection)
            ->with('user_name', $to_user->name);
    }

    public function remove($id)
    {
        $to_user = User::findOrFail($id);
        Connection::disconnect(Auth::user(), $to_user);
        return view('users.disconnected')
            ->with('user_name', $to_user->name);
    }

}
