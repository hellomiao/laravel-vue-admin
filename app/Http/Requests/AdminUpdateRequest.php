<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminUpdateRequest extends Request
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
            'username'=>'required|unique:admin,name,'.$this->get('id').'|max:255',
            'password'=>'min:6|max:50'
        ];
    }
}
