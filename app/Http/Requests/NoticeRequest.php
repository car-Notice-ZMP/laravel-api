<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
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
            'title'   => 'required|string|between:5,20',
            'message' => 'required|string|between:5,200',
            'mark'    => 'required|string|between:2,20',
            'model'   => 'required|string|between:2,20',
            'color'   => 'required|string|between:5,20',
            'year'    => 'between:4,4',
            'body'    => 'required|string|between:5,15',
            'mileage' => 'string',
            'price'   => 'string',
            'image'   => 'required|image:jpeg,png,jpg,gif,svg|max:4048'

            //
        ];
    }

    public function messages()
    {
        return [
            'title.required'   => 'To pole jest wymagane',
            'title.string'     => 'Tytuł ogłoszenia nie może być liczbą',
            'title.between'    => 'Tytuł ogłoszenia musi mieścić się w przedziale 5-20 znaków',
            'message.string'   => 'Zawartość ogłoszenia nie może być liczbą',
            'message.required' => 'To pole jest wymagane',
            'message.between'  => 'Wiadomość musi mieścić się w przedziale 5-200 znaków',
            'mark.required'    => 'To pole jest wymagane',
            'mark.between'     => 'To pole musi zawierać od 5 do 20 znaków',
            'model.required'   => 'To pole jest wymagane',
            'model.between'    => 'To pole musi zawierać od 5 do 20 znaków',
            'color.required'   => 'To pole jest wymagane',
            'color.between'    => 'To pole musi zawierać od 5 do 20 znaków',
            'year.between'     => 'To pole musi zawierać 4 znaki',
            'body.required'    => 'To pole musi zawierać od 5 do 15 znaków',
            'body.between'     => 'To pole musi zawierać od 5 do 15 znaków',
            'image.required'   => 'Dodanie zdjęcia pojazdu jest obowiązkowe',
            'image.image'      => 'Dodany plik musi być zdjęciem'
        ];
    }
}
