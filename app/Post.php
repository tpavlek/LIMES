<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public $table = "posts";
    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
