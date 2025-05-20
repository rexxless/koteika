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
            'avatar.image' => 'Аватар должен быть изображением.',
            'avatar.mimes' => 'Аватар должен быть в формате: jpeg, png, jpg.',
            'avatar.max' => 'Размер аватара не должен превышать 2 МБ.',

            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'name.string' => 'Поле "Имя" должно быть строкой.',
            'name.max' => 'Имя не должно превышать 255 символов.',

            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.email' => 'Неверный адрес электронной почты.',
            'email.max' => 'Email не должен превышать 255 символов.',
            'email.unique' => 'Этот Email уже зарегистрирован.',

            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.string' => 'Пароль должен быть строкой.',
            'password.min' => 'Пароль должен содержать не менее 8 символов.',

            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone.string' => 'Телефон должен быть строкой.',
            'phone.max' => 'Телефон не должен превышать 15 символов.',
            'phone.unique' => 'Этот номер телефона уже зарегистрирован.',
        ];
    }

}
