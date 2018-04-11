<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public $table = "posts";
    public $guarded = [];

    public function author()
    {
        return $this->morphTo();
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function hasImage()
    {
        return $this->img_url !== null;
    }

    public function getImage()
    {
        return "/img/posts/" . $this->img_url;
    }
}
