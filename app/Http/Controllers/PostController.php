<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreatePostRequest;
use App\Http\Responses\CreatePostResponse;
use App\Location;
use App\Post;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function create($id)
    {
        $location = Location::with('posts')->findOrFail($id);

        return view('posts.create')->with("location", $location);
    }

    /**
     * @param CreatePostRequest $request
     * @param $id
     * @return $this|CreatePostResponse
     */
    public function store(CreatePostRequest $request, $id)
    {
        /** @var Location $location */
        $location = Location::findOrFail($id);

        $post = Post::createFromRequest($location, $request);

        return new CreatePostResponse($post);
    }
}
