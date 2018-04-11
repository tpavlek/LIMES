<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

<<<<<<< HEAD

=======
    public function posts()
    {
        return $this->morphMany(Post::class, 'author');
    }

    public function getImage()
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower($this->email));
    }
>>>>>>> master
}
