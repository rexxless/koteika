<?php

namespace App\Http\Requests;

use App\Models\Amenity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAmenityNameRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:64', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u', 'unique:amenities,name']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле name обязательно для заполнения.',
            'name.string' => 'Поле name должно быть строкой.',
            'name.max' => 'Поле name не должно превышать 64 символов.',
            'name.regex' => 'Поле name может содержать только буквы, цифры и специальные символы.',
            'name.unique' => 'Такое оснащение номера уже существует.',
        ];
    }
}
