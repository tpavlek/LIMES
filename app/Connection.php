<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Connection extends Model
{
    //Return a list of connections available to you
    public static function getIncomingConnections(User $user)
    {
        $ids = self::where('user_id', $user->id)->pluck('owner_id')->toArray();
        return array_map(function($id){ return User::find($id); }, $ids);
    }

    //Return a list of connections you've attempted to make
    public static function getOutgoingConnections(User $user)
    {
        $ids = self::where('owner_id', $user->id)->pluck('user_id')->toArray();
        return array_map(function($id){ return User::find($id); }, $ids);
    }

    public static function connect(User $from, User $to)
    {
        $connection = new Connection();
        $connection->owner_id = $from->id;
        $connection->user_id = $to->id;
        return $connection;
    }

    public static function disconnect(User $from, User $to)
    {
        $connection = Connection::where('owner_id', $from->id)->where('user_id', $to->id)->firstOrFail();
        $connection->delete();
    }

}
