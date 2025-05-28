<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048', 'max_files:1'],
            'name' => ['required', 'regex:/^[A-Za-zА-Яа-яЁё\s.\-]+$/u', 'max:255'],
            'phone' => ['required', 'regex:/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/', 'unique:users,phone'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'max:30', 'regex:/^[A-Za-z0-9!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]+$/'],
        ];
    }


    public function messages(): array
    {
        return [
            'avatar.image' => 'Аватар должен быть изображением.',
            'avatar.mimes' => 'Аватар должен быть в формате jpeg или png.',
            'avatar.max' => 'Размер аватара не должен превышать 2 МБ.',
            'avatar.max_files' => 'Можно загрузить только один файл.',
            'avatar.*' => 'Не удалось загрузить аватар',

            'name.max' => 'Максимальная длина имени - 255 символов.',
            'name.required' => 'Поле name обязательно для заполнения.',
            'name.regex' => 'Имя может содержать только кириллические буквы, пробелы, точки и тире.',

            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone.regex' => 'Телефон должен быть в формате +7(ХХХ)ХХХ-ХХ-ХХ.',
            'phone.unique' => 'Пользователь с такими данными уже существует.',

            'email.required' => 'Поле "Почта" обязательно для заполнения.',
            'email.email' => 'Введена неверная электронная почта.',
            'email.unique' => 'Пользователь с такими данными уже существует.',

            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.min' => 'Пароль должен содержать не менее 8 символов.',
            'password.regex' => 'Пароль может содержать только латинские символы, цифры и специальные символы.',
        ];
    }


}
