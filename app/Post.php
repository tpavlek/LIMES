<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{

    public $table = "posts";
    protected $attributes = ['imageLocation' => 'default.jpeg'];
    public $guarded = [];

    public function author()
    {
        return $this->morphTo();
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

<<<<<<< HEAD
=======
    public function hasImage()
    {
        return $this->img_url !== null;
    }

    public function getImage()
    {
        return "/img/posts/" . $this->img_url;
    }
>>>>>>> master
}
