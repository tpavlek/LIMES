<?php

namespace App\Http\Controllers;
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
     * @param Request $request
     * @param $id
     * @return $this|CreatePostResponse
     */
    public function store(Request $request, $id)
    {
        $response = new CreatePostResponse(false, null, []);

        try
        {
            $location = Location::findOrFail($id);
        }
        catch (ModelNotFoundException $e){
            $response->addError(["Location does not exist"]);
            return $response;
        }


        //validate data ~ TODO: move to configuration file
        $request->validate([
            'body' => 'required|max:50000|min:10',
            'image' => 'max: 2048'
        ]);

        //create post
        $post = new Post();
        $post->body = $request->input('body');

        //TODO: How will this handle anonymous users?
        $user = Auth::user();
        $post->author_id = $user->id;
        $post->author_type = get_class($user);


        $post->img_url = $request->hasFile('image') ?
            basename($request->file('image')->store('public')) : NULL;

        $post->location()->associate( $location );
        $post->save();


        if ($request->ajax())
        {
            $response->id = $post->id;
            $response->success = true;
            return $response;
        }

        return view('posts.completed')
            ->with('post', $post);
    }
}
