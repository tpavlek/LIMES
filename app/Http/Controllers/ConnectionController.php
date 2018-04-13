<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\User;
use App\Connection;
use Illuminate\Support\Facades\Auth;
use App\Http\Responses\CreateConnectionResponse;

class ConnectionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        /**
         * @var User
         */
        $user = User::findOrFail($id);

        $incoming = $user->incomingConnections();
        $outgoing = $user->outgoingConnections();

        return view('users.connections')
            ->with('user', $user)
            ->with('incoming', $incoming)
            ->with('outgoing', $outgoing);
    }

    public function add(Request $request, $id)
    {
        $response = new CreateConnectionResponse(false, null, []);

        try
        {
            $to_user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e)
        {
            $response->addError("Target user not found, connection not created.");
            return $response;
        }

        //guaranteed by middleware
        $user = Auth::user();
        $connection = Connection::connect($user, $to_user);

        if(Auth::user()->hasAlreadyConnectedWith($to_user))
        {
            $response->addError("Connection already made, connection not created.");
        }
        else{
            $connection->save();
            $response->success = true;
            $response->id = $connection->id;
        }

        if ($request->ajax())
        {
            return $response;
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
