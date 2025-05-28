<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => ['nullable', 'regex:/^[A-Za-zА-Яа-яЁё\s.\-]+$/u', 'max:255'],
            'phone' => ['nullable', 'regex:/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/', 'unique:users,phone'],
            'email' => ['nullable', 'email', 'unique:users,email'],
            'password' => ['nullable', 'min:8', 'max:30', 'regex:/^[A-Za-z0-9!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]+$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'Введена неверная электронная почта.',
            'email.unique' => 'Пользователь с такими данными уже существует.',

            'name.max' => 'Максимальная длина имени - 255 символов.',
            'name.regex' => 'Имя может содержать только кириллические буквы, пробелы, точки и тире.',

            'password.min' => 'Минимальная длина пароля - 8 символов.',
            'password.max' => 'Максимальная длина пароля - 30 символов.',
            'password.regex' => 'Пароль может содержать только латинские буквы, цифры и спец. символы.',

            'phone.unique' => 'Пользователь с такими данными уже существует.',
            'phone.regex' => 'Телефон должен быть в формате +7(ХХХ)ХХХ-ХХ-ХХ.',
        ];
    }
}
