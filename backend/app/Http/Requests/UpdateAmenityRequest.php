<?php

namespace App\Http\Requests;

use App\Models\Amenity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAmenityRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:255', 'unique:amenities,name'],
            'icon' => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048']
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Значение поля name должно быть строкой.',
            'name.max' => 'Максимальная длина поля name 255 символов.',
            'name.unique' => 'Такое оснащение номера уже есть.',

            'icon.image' => 'Значение поля icon должно быть изображением.',
            'icon.mimes' => 'Значение поля icon должно быть в формате jpeg или png.',
            'icon.max' => 'Поле icon не должно превышать 2 МБ.',
        ];
    }
}
