<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
            'title' => ['required', 'regex:/^[А-Яа-яЁё\s]+$/u'],
            'length' => ['required', 'integer', 'min:1'],
            'height' => ['required', 'integer', 'min:1'],
            'width' => ['required', 'integer', 'min:1'],
            'amenities' => ['nullable', 'array', 'exists:amenities,name'],
            'price' => ['required', 'integer', 'min:0'],
            'photos' => ['sometimes', 'array', 'max:5'],
            'photos.*' => ['image', 'mimes:jpeg,png', 'max:2048'], // размер в КБ
            'showcase' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле title обязательно для заполнения.',
            'title.regex' => 'Поле title должно содержать только кириллические символы и пробелы.',

            'length.required' => 'Поле length обязательно для заполнения.',
            'length.integer' => 'Поле length должно быть целым числом.',
            'length.min' => 'Поле length должно быть не менее 1.',

            'height.required' => 'Поле height обязательно для заполнения.',
            'height.integer' => 'Поле height должно быть целым числом.',
            'height.min' => 'Поле height должно быть не менее 1.',

            'width.required' => 'Поле width обязательно для заполнения.',
            'width.integer' => 'Поле width должно быть целым числом.',
            'width.min' => 'Поле width должно быть не менее 1.',

            'amenities.required' => 'Необходимо выбрать хотя бы одну опцию оснащения.',
            'amenities.array' => 'Поле amenities должно быть массивом.',
            'amenities.exists' => 'Выбранное оснащение не найдено.',

            'price.required' => 'Поле price обязательно для заполнения.',
            'price.integer' => 'Поле price должно быть целым числом.',
            'price.min' => 'Цена не может быть отрицательной.',

            'photos.array' => 'Поле photos должно быть массивом.',
            'photos.max' => 'Можно загрузить не более 5 фотографий.',
            'photos.*.image' => 'Каждый файл должен быть изображением.',
            'photos.*.mimes' => 'Фотографии должны быть в формате jpeg или png.',
            'photos.*.max' => 'Размер каждой фотографии не должен превышать 2 МБ.',

            'showcase.boolean' => 'Поле showcase должно быть логическим значением (true или false).',
        ];
    }


}
