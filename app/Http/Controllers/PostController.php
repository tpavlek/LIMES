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

        //$location = Location::findOrFail($id);

        //validate data ~ TODO: move to configuration file
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:50000',
            'image' => 'max: 2048'
        ]);

        //create post
        $post = new Post();
        $post->title = $request['title'];
        $post->body = $request['body'];


        //TODO: name of default from config file
        //TODO: A nicer way to get the URL of the resource.
        $post->imageLocation = $request->hasFile('image') ?
            "".basename($request->file('image')->store('public')) : 'default.jpeg';

        //associate post
        //$post->location()->associate( $location );

        $post->save();

        //save post to DB
        return view('posts.completed')
            ->with("title", $request["title"])
            ->with('body', $request['body'] )
            ->with('image_url', $post->imageLocation );
    }
}
