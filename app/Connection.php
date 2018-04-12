<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    //Return a list of connections available to you
    public static function getAvailableConnections($user)
    {
        return self::all()->where('user_id', $user->id);
    }

    //Return a list of connections you've attempted to make
    public static function getOwnedConnections($user)
    {
        return self::all()->where('owner_id', $user->id);
    }
}
