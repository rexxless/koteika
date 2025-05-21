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
            'title' => ['nullable', 'regex:/^[А-Яа-яЁё\s]+$/u'],
            'length' => ['nullable', 'integer', 'min:1'],
            'height' => ['nullable', 'integer', 'min:1'],
            'width' => ['nullable', 'integer', 'min:1'],
            'amenities' => ['nullable', 'array', 'exists:amenities,name'],
            'price' => ['nullable', 'integer', 'min:0'],
            'photos' => ['sometimes', 'array', 'max:5'],
            'photos.*' => ['image', 'mimes:jpeg,png', 'max:2048'], // размер в КБ
            'showcase' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.regex' => 'Поле "Название" должно содержать только кириллические символы и пробелы.',

            'length.integer' => 'Поле "Длина" должно быть целым числом.',
            'length.min' => 'Поле "Длина" должно быть не менее 1.',

            'height.integer' => 'Поле "Высота" должно быть целым числом.',
            'height.min' => 'Поле "Высота" должно быть не менее 1.',

            'width.integer' => 'Поле "Ширина" должно быть целым числом.',
            'width.min' => 'Поле "Ширина" должно быть не менее 1.',

            'amenities.array' => 'Поле "Оснащение" должно быть массивом.',
            'amenities.exists' => 'Выбранное оснащение не найдено.',

            'price.integer' => 'Поле "Цена" должно быть целым числом.',
            'price.min' => 'Цена не может быть отрицательной.',

            'photos.array' => 'Поле "Фотографии" должно быть массивом.',
            'photos.max' => 'Можно загрузить не более 5 фотографий.',
            'photos.*.image' => 'Каждый файл должен быть изображением.',
            'photos.*.mimes' => 'Фотографии должны быть в формате jpeg или png.',
            'photos.*.max' => 'Размер каждой фотографии не должен превышать 2 МБ.',

            'showcase.boolean' => 'Поле "Отображать на главной" должно быть логическим значением (true или false).',
        ];
    }
}
