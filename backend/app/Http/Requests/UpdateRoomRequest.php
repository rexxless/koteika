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
            'title' => ['nullable', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u', 'max:255'],
            'description' => ['nullable', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u', 'max:255'],
            'length' => ['nullable', 'integer', 'min:1', 'max:200'],
            'height' => ['nullable', 'integer', 'min:1', 'max:200'],
            'width' => ['nullable', 'integer', 'min:1', 'max:200'],
            'amenities' => ['nullable', 'array', 'exists:amenities,name'],
            'price' => ['nullable', 'integer', 'min:0', 'max:100000'],
            'showcase' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.regex' => 'Поле title может содержать только буквы, цифры и специальные символы.',
            'title.max' => 'Максимальная длина поля title - 255 символов',

            'description.regex' => 'Поле description может содержать только буквы, цифры и специальные символы.',
            'description.max' => 'Максимальная длина поля description - 255 символов',

            'length.integer' => 'Поле length должно быть целым числом.',
            'length.min' => 'Значение поля length должно быть не меньше 1.',
            'length.max' => 'Значение поля length должно быть не больше 200.',

            'height.integer' => 'Поле height должно быть целым числом.',
            'height.min' => 'Значение поля height должно быть не меньше 1.',
            'height.max' => 'Значение поля height должно быть не больше 200.',

            'width.integer' => 'Поле width должно быть целым числом.',
            'width.min' => 'Значение поля width должно быть не меньше 1.',
            'width.max' => 'Значение поля width должно быть не больше 200.',

            'amenities.array' => 'Поле amenities должно быть массивом.',
            'amenities.exists' => 'Выбранное оснащение не найдено.',

            'price.integer' => 'Поле price должно быть целым числом.',
            'price.min' => 'Цена не может быть отрицательной.',
            'price.max' => 'Цена не может быть больше 100000.',

            'showcase.boolean' => 'Поле showcase должно быть логическим значением (true или false).',
        ];
    }
}
