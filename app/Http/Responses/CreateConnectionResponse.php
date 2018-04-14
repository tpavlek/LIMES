<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use App\Location;

class CreateConnectionResponse implements Responsable{

    public $success;
    public $id;

    /**
     * @var array
     */
    private $errors;

    public function __construct(Bool $success, $id, Array $errors)
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