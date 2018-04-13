<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Connection extends Model
{

    protected $fillable = ['user_id', 'owner_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    //Return a list of connections you've attempted to make
    public static function getIncomingConnections(User $user)
    {
        return self::where('user_id', $user->id)->get()->map(function ($connection) { return $connection->owner; });
    }

    //Return a list of connections available to you
    public static function getOutgoingConnections(User $user)
    {
        return self::where('owner_id', $user->id)->get()->map(function ($connection) { return $connection->user; });
    }

    public static function connect(User $from, User $to)
    {
        return Connection::create([
            'user_id' => $to->id,
            'owner_id' => $from->id
        ]);
    }

    public static function disconnect(User $from, User $to)
    {
        Connection::where('owner_id', $from->id)->where('user_id', $to->id)->firstOrFail()->delete();
    }

}

