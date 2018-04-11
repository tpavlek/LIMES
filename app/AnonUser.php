<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnonUser extends Model
{

    public $table = "anon_users";

    protected $guarded = [];

    public function getImage()
    {
        return "/img/default-profile.png";
    }

}
