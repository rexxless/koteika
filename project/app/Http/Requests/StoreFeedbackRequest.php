<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
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
            'rate' => 'required|integer|between:1,5',
            'title' => 'string|max:255|nullable',
            'description' => 'string|nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'rate.required' => 'Оценка обязательна для заполнения.',
            'rate.integer' => 'Оценка должна быть целым числом.',
            'rate.between' => 'Оценка должна быть в пределах от 1 до 5.',

            'title.string' => 'Заголовок должен быть строкой.',
            'title.max' => 'Заголовок не должен превышать 255 символов.',

            'description.string' => 'Описание должно быть строкой.',
        ];
    }

}
