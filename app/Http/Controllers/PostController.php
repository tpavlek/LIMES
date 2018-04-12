<?php

namespace App\Http\Controllers;
use App\Location;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function create($id)
    {
        //$location = Location::with('posts')->findOrFail($id);

        return view('posts.create')->with("location", $id);
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
        $post->body = $request['body'];

        $post->author_id = 1;
        $post->author_type = "App\User";


        $post->img_url = $request->hasFile('image') ?
            basename($request->file('image')->store('public')) : NULL;

        $post->location()->associate( $location );

        $post->save();

        //save post to DB
        return view('posts.completed')
            ->with('post', $post);
    }
}
