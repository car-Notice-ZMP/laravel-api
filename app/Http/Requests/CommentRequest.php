<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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

            'content' => 'required|string|between:5,200',

            //
        ];
    }

    public function messages()
    {
        return [
            'content.required'   => 'To pole jest wymagane',
            'content.between'  => 'Treść komentarza musi mieścić się w przedziale 5-200 znaków',
        ];
    }
}
