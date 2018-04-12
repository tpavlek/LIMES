<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    //Return a list of connections available to you
    public static function getAvailableConnections($user)
    {
        return self::where('user_id', $user->id)->get();
    }

    //Return a list of connections you've attempted to make
    public static function getOwnedConnections($user)
    {
        return self::where('owner_id', $user->id)->get();
    }

    public static function connect(User $from, User $to)
    {
        $connection = new Connection();
        $connection->owner_id = $from->id;
        $connection->user_id = $to->id;
        return $connection;
    }
}
