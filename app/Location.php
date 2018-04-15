<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @property int id
 * @property string img_path
 */
class Location extends Model
{

    protected $guarded = [];

    public static function build($name, array $args = [])
    {
        $default_args = [
            'name' => $name,
            'ref_uuid' => Uuid::uuid4()->toString(),
        ];

        return self::create(array_merge($default_args, $args));
    }

    public function hasImage()
    {
        return $this->img_path;
    }

    public function getImage()
    {
        return "/img/locations/" . $this->img_path;
    }

    /**
     * @param $uuid
     * @return self
     */
    public static function findUuid($uuid)
    {
        return self::query()->where('ref_uuid', $uuid)->firstOrFail();
    }

    /**
     * @return bool
     */
    public function hasEvent()
    {
        // Passing null into strtotime results in 0 (A date in 1969).
        // For all cases, that provides an acceptable range, so we don't need to check.

        return (strtotime($this->event_start) < strtotime('now'))
            && (strtotime('now') < strtotime($this->event_end));
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
