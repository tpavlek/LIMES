<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\User;
use App\Connection;
use Illuminate\Support\Facades\Auth;
use Responses\App\CreatePostResponse;

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

        try
        {
            $to_user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e)
        {
            return new CreatePostResponse(false, null, ["Target user doesn't exist."]);
        }

        //guaranteed by middleware
        $user = Auth::user();
        $connection = Connection::connect($user, $to_user);

        if(Auth::user()->hasAlreadyConnectedWith($to_user))
        {
            return new CreatePostResponse(false, null, ["User has already connected with this user."]);
        }

        $connection->save();

        if ($request->ajax())
        {
            return new CreatePostResponse(true, $connection->id, []);
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
