<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
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
            'title'    => 'required|string|between:5,20',
            'content'  => 'required|string|between:5,70',
            'receiver' => 'required|string|email',
        ];
    }

    public function messages()
    {
        return [
            'title.required'    => 'To pole jest wymagane',
            'content.required'  => 'To pole jest wymagane',
            'title.between'     => 'Tytuł ogłoszenia musi mieścić się w przedziale 5-20 znaków',
            'content.between'   => 'Treść wiadomości musi mieścić się w przedziale 5-70 znaków',
            'receiver.required' => 'To pole jest wymagane',
        ];
    }
}
