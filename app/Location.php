<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string img_path
 */
class Location extends Model
{

    protected $guarded = [];

    public function getImage()
    {
        return "/img/" . $this->img_path;
    }

    /**
     * @param $uuid
     * @return self
     */
    public static function findUuid($uuid)
    {
        return self::query()->where('ref_uuid', $uuid)->firstOrFail();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
