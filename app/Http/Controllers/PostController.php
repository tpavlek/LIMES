<?php

namespace App\Http\Controllers;
use App\Location;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function create($id)
    {
        $location = Location::with('posts')->findOrFail($id);

        return view('posts.create')->with("location", $location);
    }

    public function store(Request $request, $id)
    {

        $location = Location::findOrFail($id);

        //validate data ~ TODO: move to configuration file
        $request->validate([
            'body' => 'required|max:50000',
            'image' => 'max: 2048'
        ]);

        //create post
        $post = new Post();
        $post->body = $request->input('body');

        //TODO: This should be from session data, the currently authenticated user.
        //This is placeholder code so that posts can still be added.
        $post->author_id = 1;
        $post->author_type = User::class;


        $post->img_url = $request->hasFile('image') ?
            basename($request->file('image')->store('public')) : NULL;

        $post->location()->associate( $location );

        $post->save();

        //save post to DB
        return view('posts.completed')
            ->with('post', $post);
    }
}
