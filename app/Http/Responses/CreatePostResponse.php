<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class CreatePostResponse implements Responsable
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var Boolean
     */
    public $success;

    /**
     * @var array
     */
    public $errors;

    public function __construct(Bool $success, $id, Array $errors)
    {
        $this->success = $success;
        $this->id = $id;
        $this->errors = $errors;
    }

    public function toResponse($request)
    {
        return response(['success'=> $this->success, 'id' => $this->id, 'errors' => $this->errors]);
    }

    public function addError($error){
        array_push($this->errors, $error);
    }
}