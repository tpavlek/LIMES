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

    public function accept($id)
    {
        Connection::findOrFail($id)->update([ 'accepted' => true ]);

        return redirect()->route('profile');
    }

    public function remove($id)
    {
        Connection::findOrFail($id)->delete();

        return redirect()->route('profile');
    }

}
