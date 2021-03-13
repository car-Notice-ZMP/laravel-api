<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name'     => 'required|string|between:2,100',
            'email'    => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'avatar'   => 'mimes:jpeg,png'

            //
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => 'To pole jest wymagane',
            'email.required'     => 'To pole jest wymagane',
            'email.string'       => 'Wprowadzony email jest niepoprawny',
            'email.unique'       => 'Podany adres email jest zajęty',
            'password.min'       => 'Hasło ma miec 6 znaków',
            'password.confirmed' => 'Wprowadzone hasła różnią się od siebie',
            'avatar.mimes'       => 'Avatar ma być w odpowiednim formacie'
        ];
    }
}

