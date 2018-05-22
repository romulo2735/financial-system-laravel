<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileFormRequest extends FormRequest
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
        $idUser = auth()->user()->id;
        return [
            'name'      =>  'required|string|max:100',
            'email'     =>  "required|string|email|max:100|unique:users,email,{$idUser},id",
            'password'  =>  'max:20',
            'image'     =>  'image'
        ];
    }
}
