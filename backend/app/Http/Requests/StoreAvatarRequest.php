<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvatarRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'avatar' => ['required', 'image', 'mimes:jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'avatar.required' => 'Поле avatar не должно быть пустым.',
            'avatar.image' => 'Аватар должен быть изображением.',
            'avatar.mimes' => 'Формат изображения должен быть jpeg, png, jpg.',
            'avatar.max' => 'Максимальный размер изображения - 2 МБ.',
            'avatar.*' => 'Не удалось загрузить аватар'
        ];
    }
}
