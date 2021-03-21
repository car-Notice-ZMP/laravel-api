<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Notice;

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
            'content' => 'required|string|between:5,200',
            'image'   => 'required|image:jpeg,png,jpg,gif,svg|max:2048'

            //
        ];
    }

    public function messages()
    {
        return [
            'title.required'   => 'To pole jest wymagane',
            'title.string'     => 'Tytuł ogłoszenia nie może być liczbą',
            'title.between'    => 'Tytuł ogłoszenia musi mieścić się w przedziale 5-20 znaków',
            'content.string'   => 'Zawartość ogłoszenia nie może być liczbą',
            'content.required' => 'To pole jest wymagane',
            'content.between'  => 'Treść ogłoszenia musi mieścić się w przedziale 5-200 znaków',
            'image.required'   => 'Dodanie zdjęcia pojazdu jest obowiązkowe',
            'image.image'      => 'Dodany plik musi być zdjęciem'
        ];
    }
}
