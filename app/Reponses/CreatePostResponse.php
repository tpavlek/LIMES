<?php

namespace Responses\App;

use Illuminate\Contracts\Support\Responsable;

class CreatePostResponse implements Responsable{

    private $success;
    private $id;

    /**
     * @var array
     */
    private $errors;

    public function __construct(Bool $success, Integer $id, Array $errors)
    {
        $this->success = $success;
        $this->id = $id;
        $this->errors = $errors;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return response(['success' => $this->success, "post_id" => $this->id, 'errors' => $this->errors]);
    }

    public function addError($error){
        array_push($this->errors, $error);
    }
}