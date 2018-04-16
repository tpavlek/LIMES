<?php

namespace App;

use App\Http\Requests\CreatePostRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int id
 */
class Post extends Model
{

    public $table = "posts";
    public $guarded = [];

    public static function createFromRequest(Location $location, CreatePostRequest $request)
    {
        $img_url = null;
        if ($request->hasFile('image')) {
            $img_url = Storage::disk('post_images')->putFile('', $request->file('image'));
        }

        $user = \Auth::check() ? \Auth::user() : AnonUser::fromNameAndIp($request->get('name'),
            $request->getClientIp());

        return self::create([
            'body' => $request->get('body'),
            'img_url' => $img_url,
            'author_id' => $user->id,
            'author_type' => get_class($user),
            'location_id' => $location->id,
        ]);
    }

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
        return '/img/posts/' . $this->img_url;
    }

    public function hasAnonymousAuthor()
    {
        return $this->author_type == AnonUser::class;
    }

    public function isConnectable()
    {
        if (!\Auth::check()) {
            return false;
        }

        if ($this->hasAnonymousAuthor()) {
            return false;
        }

        if ($this->author->id == \Auth::user()->id) {
            return false;
        }

        return true;
    }

}
