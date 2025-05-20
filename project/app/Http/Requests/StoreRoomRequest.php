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
            'photos' => ['nullable', 'array', 'max:5'],
            'photos.*' => ['image', 'mimes:jpeg,png', 'max:2048'], // размер в КБ
            'showcase' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле "Название" обязательно для заполнения.',
            'title.regex' => 'Поле "Название" должно содержать только кириллические символы и пробелы.',

            'length.required' => 'Поле "Длина" обязательно для заполнения.',
            'length.integer' => 'Поле "Длина" должно быть целым числом.',
            'length.min' => 'Поле "Длина" должно быть не менее 1.',

            'height.required' => 'Поле "Высота" обязательно для заполнения.',
            'height.integer' => 'Поле "Высота" должно быть целым числом.',
            'height.min' => 'Поле "Высота" должно быть не менее 1.',

            'width.required' => 'Поле "Ширина" обязательно для заполнения.',
            'width.integer' => 'Поле "Ширина" должно быть целым числом.',
            'width.min' => 'Поле "Ширина" должно быть не менее 1.',

            'amenities.required' => 'Необходимо выбрать хотя бы одну опцию оснащения.',
            'amenities.array' => 'Поле "Оснащение" должно быть массивом.',
            'amenities.exists' => 'Выбранное оснащение не найдено.',

            'price.required' => 'Поле "Цена" обязательно для заполнения.',
            'price.integer' => 'Поле "Цена" должно быть целым числом.',
            'price.min' => 'Цена не может быть отрицательной.',

            'photos.array' => 'Поле "Фотографии" должно быть массивом.',
            'photos.max' => 'Можно загрузить не более 5 фотографий.',
            'photos.*.image' => 'Каждый файл должен быть изображением.',
            'photos.*.mimes' => 'Фотографии должны быть в формате jpeg или png.',
            'photos.*.max' => 'Размер каждой фотографии не должен превышать 2 МБ.',

            'featured.boolean' => 'Поле "Отображать на главной" должно быть логическим значением (true или false).',
        ];
    }


}
