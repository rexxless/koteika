<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAmenityIconRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'icon' => ['image', 'mimes:jpeg,png', 'max:2048']
        ];
    }

    public function messages()
    {
        return [
            'icon.image' => 'Поле icon должно быть изображением.',
            'icon.mimes' => 'Поле icon должно быть в формате jpeg или png.',
            'icon.max' => 'Размер поля icon не должен превышать 2 МБ.',
            'icon.*' => 'Не удалось загрузить иконку.',
        ];
    }
}
