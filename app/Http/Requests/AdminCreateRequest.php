<?php

namespace App\Http\Requests;



class AdminCreateRequest extends Request
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
            'username'=>'required|unique:admin|min:4|max:255',
            'password'=>'required|min:6|max:50'
        ];
    }
}
