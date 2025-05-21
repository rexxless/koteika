<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSocialLinkRequest extends FormRequest
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
            "social_network" => 'required|string|max:255',
            "url" => "required|url",
        ];
    }

    public function messages(): array
    {
        return [
            "social_network.required" => 'Поле "social_network" обязательно для заполнения.',
            "social_network.string" => "Название социальной сети должно быть строкой",
            "social_network.max" => "Максимальная длина названия социальной сети 255 символов.",

            "url.required" => 'Поле "URL" обязательно для заполнения.',
            "url.url" => 'Введите корректный URL-адрес.',
        ];
    }
}
