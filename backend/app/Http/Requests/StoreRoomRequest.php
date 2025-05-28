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
            'title' => ['required', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u', 'max:255'],
            'description' => ['required', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u', 'max:255'],
            'length' => ['required', 'integer', 'min:1', 'max:200'],
            'height' => ['required', 'integer', 'min:1', 'max:200'],
            'width' => ['required', 'integer', 'min:1', 'max:200'],
            'amenities' => ['sometimes', 'array', 'exists:amenities,name'],
            'price' => ['required', 'integer', 'min:0', 'max:100000'],
            'photos' => ['required', 'array', 'min:1', 'max:5'],
            'photos.*' => ['image', 'mimes:jpeg,png', 'max:2048'], // размер в КБ
            'showcase' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле title обязательно для заполнения.',
            'title.regex' => 'Поле title может содержать только буквы, цифры и специальные символы.',
            'title.max' => 'Максимальная длина поля title - 255 символов',

            'description.required' => 'Поле description обязательно для заполнения.',
            'description.regex' => 'Поле description может содержать только буквы, цифры и специальные символы.',
            'description.max' => 'Максимальная длина поля description - 255 символов',

            'length.required' => 'Поле length обязательно для заполнения.',
            'length.integer' => 'Поле length должно быть целым числом.',
            'length.min' => 'Значение поля length должно быть не меньше 1.',
            'length.max' => 'Значение поля length должно быть не больше 200.',

            'height.required' => 'Поле height обязательно для заполнения.',
            'height.integer' => 'Поле height должно быть целым числом.',
            'height.min' => 'Значение поля height должно быть не меньше 1.',
            'height.max' => 'Значение поля height должно быть не больше 200.',

            'width.required' => 'Поле width обязательно для заполнения.',
            'width.integer' => 'Поле width должно быть целым числом.',
            'width.min' => 'Значение поля width должно быть не меньше 1.',
            'width.max' => 'Значение поля width должно быть не больше 200.',

            'amenities.required' => 'Необходимо выбрать хотя бы одну опцию оснащения.',
            'amenities.array' => 'Поле amenities должно быть массивом.',
            'amenities.exists' => 'Выбранное оснащение не найдено.',

            'price.required' => 'Поле price обязательно для заполнения.',
            'price.integer' => 'Поле price должно быть целым числом.',
            'price.min' => 'Цена не может быть отрицательной.',
            'price.max' => 'Цена не может быть больше миллиарда.',

            'photos.required' => 'Поле photos обязательно для заполнения.',
            'photos.array' => 'Поле photos должно быть массивом.',
            'photos.min' => 'Загрузите хотя бы одну фотографию.',
            'photos.max' => 'Можно загрузить не более 5 фотографий.',
            'photos.*.image' => 'Каждый файл должен быть изображением.',
            'photos.*.mimes' => 'Фотографии должны быть в формате jpeg или png.',
            'photos.*.max' => 'Размер каждой фотографии не должен превышать 2 МБ.',
            'photos.*.*' => 'Не удалось загрузить фотографии.',

            'showcase.boolean' => 'Поле showcase должно быть логическим значением (true или false).',
        ];
    }


}
