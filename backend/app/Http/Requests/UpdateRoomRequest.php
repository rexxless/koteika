<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
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
            'title' => ['nullable', 'regex:/^А-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u', 'max:255'],
            'length' => ['nullable', 'integer', 'min:1'],
            'height' => ['nullable', 'integer', 'min:1'],
            'width' => ['nullable', 'integer', 'min:1'],
            'amenities' => ['nullable', 'array', 'exists:amenities,name'],
            'price' => ['nullable', 'integer', 'min:0'],
            'showcase' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.regex' => 'Поле title может содержать только буквы, цифры и специальные символы.',
            'title.max' => 'Поле title не должно превышать 255 символов.',

            'length.integer' => 'Поле length должно быть целым числом.',
            'length.min' => 'Поле length должно быть не менее 1.',

            'height.integer' => 'Поле height должно быть целым числом.',
            'height.min' => 'Поле height должно быть не менее 1.',

            'width.integer' => 'Поле width должно быть целым числом.',
            'width.min' => 'Поле width должно быть не менее 1.',

            'amenities.array' => 'Поле amenities должно быть массивом.',
            'amenities.exists' => 'Выбранное оснащение не найдено.',

            'price.integer' => 'Поле price должно быть целым числом.',
            'price.min' => 'Поле price не может быть отрицательным.',

            'showcase.boolean' => 'Поле showcase должно быть логическим значением (true или false).',
        ];
    }
}
