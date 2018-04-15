<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

/**
 * @property bool facebook_connected
 * @property int id
 * @property bool is_admin
 */
class User extends Authenticatable
{

    use Notifiable;

    protected $guarded = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function buildFromFacebook($socialite_user)
    {
        $instance = self::create([
            'email' => $socialite_user->email,
            'name' => $socialite_user->name,
            'password' => Hash::make(str_random(8)),
            'facebook_connected' => true,
        ]);

        $instance->reloadFacebookAvatar($socialite_user);

        return $instance;
    }

    public function reloadFacebookAvatar($socialite_user)
    {
        \File::put(public_path() . "/img/user/" . $this->id . ".jpg",
            file_get_contents($socialite_user->getAvatar()));
    }

    public function posts()
    {
        return $this->morphMany(Post::class, 'author');
    }

    public function getImage()
    {
        if (\File::exists(public_path() . "/img/user/{$this->id}.jpg")) {
            return "/img/user/{$this->id}.jpg";
        }

        return "https://www.gravatar.com/avatar/" . md5(strtolower($this->email));
    }

    public function hasNotConnectedFacebook()
    {
        return !$this->hasConnectedFacebook();
    }

    public function hasConnectedFacebook()
    {
        return $this->facebook_connected;
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function incomingConnections()
    {
        return Connection::getIncomingConnections($this);
    }

    public function outgoingConnections()
    {
        return Connection::getOutgoingConnections($this);
    }

    public function hasAlreadyConnectedWith($target_user)
    {
        return Connection::query()
                ->where('owner_id', $this->id)
                ->where('user_id', $target_user->id)->count() > 0;
    }

}
