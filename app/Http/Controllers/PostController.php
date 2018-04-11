<?php

namespace App\Http\Controllers;
use App\Location;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function create($id)
    {
        //$location = Location::with('posts')->findOrFail($id);

        //with location => $location
        return view('posts.create')->with("location", $id);
    }

    public function store(Request $request, $id)
    {
        //validate data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        //create post
        $post = new Post();
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];

        //associate post
        //$post->location()->associate( Location::findOrFail($id) );

        $post->save();

        //save post to DB
        return view('posts.completed')->with("data", $request->input("body"));
    }
}
