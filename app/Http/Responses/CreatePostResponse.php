<?php

namespace App\Http\Responses;

use App\Post;
use Illuminate\Contracts\Support\Responsable;

class CreatePostResponse implements Responsable
{

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function toResponse($request)
    {
        if ($request->ajax()) {
            return response()->json([ 'success' => true, 'post_id' => $this->post->id ]);
        }

        return view('posts.completed')
            ->with('post', $this->post);
    }
}
