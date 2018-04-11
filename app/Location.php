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
