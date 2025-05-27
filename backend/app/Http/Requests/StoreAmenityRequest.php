<?php

namespace App\Http\Requests;

use App\Models\Amenity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAmenityRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:64', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u', 'unique:amenities,name'],
            'icon' => ['required', 'image', 'mimes:jpeg,png', 'max:2048']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле "Название" обязательно для заполнения.',
            'name.string' => 'Поле "Название" должно быть строкой.',
            'name.max' => 'Поле "Название" не должно превышать 64 символов.',
            'name.regex' => 'Поле "Название" может содержать только буквы, цифры и специальные символы.',
            'name.unique' => 'Такое оснащение номера уже существует.',

            'icon.required' => 'Поле "Иконка" обязательно для заполнения.',
            'icon.image' => 'Поле "Иконка" должно быть изображением.',
            'icon.mimes' => 'Поле "Иконка" должно быть в формате jpeg или png.',
            'icon.max' => 'Размер поля "Иконка" не должен превышать 2 МБ.',
        ];
    }
}
