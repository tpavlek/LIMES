<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AnonUser extends Model
{

    public $table = "anon_users";

    protected $guarded = [];

    public static function fromNameAndIp($name, $ip)
    {
        return self::query()
            ->firstOrCreate([
                'name' => $name,
                'ip' => $ip
            ]);
    }

    public function getImage()
    {
        return "/img/default-profile.png";
    }

}
