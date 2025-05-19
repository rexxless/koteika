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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:15|unique:users',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле "Почта" обязательно для заполнения.',
            'email.email' => 'Введена неверная электронная почта.',
            'email.unique' => 'Почта уже занята.',
            'email.max' => 'Максимальная длина почты - 255 символов.',

            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'name.max' => 'Максимальная длина имени - 255 символов.',

            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.min' => 'Минимальная длина пароля - 8 символов.',

            'phone.unique' => 'Номер телефона уже занят.',
            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone.max' => 'Максимальная длина номера телефона - 15 цифр.',

            'avatar.image' => 'Аватар должен быть изображением.',
            'avatar.mimes' => 'Формат изображения должен быть jpeg, png, jpg.',
            'avatar.max' => 'Максимальный размер изображения - 2 МБ.',
        ];
    }
}
