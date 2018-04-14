<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => 'required|max:50000|min:10',
            'image' => 'image'
        ];
    }

    public function withValidator(Validator $validator)
    {
        // If a user is not logged in, we require a name attribute to create an anonymous user.
        $validator->sometimes('name', 'required|min:3', function() {
            return ! \Auth::check();
        });
    }
}
