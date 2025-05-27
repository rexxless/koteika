<?php

namespace App\Http\Requests;

use App\Rules\DescriptionRequiresTitle;
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
            'title' => ['nullable', 'string', 'max:64', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?]+$/u'],
            'description' => ['nullable', 'string', 'max:255', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $title = $this->input('title');
            $description = $this->input('description');

            if (! (new DescriptionRequiresTitle($title, $description))->passes('', '')) {
                $validator->errors()->add('title', 'Введите заголовок отзыва.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'rate.required' => 'Оценка обязательна для заполнения.',
            'rate.integer' => 'Оценка должна быть целым числом.',
            'rate.between' => 'Оценка должна быть в пределах от 1 до 5.',

            'title.string' => 'Заголовок должен быть строкой.',
            'title.max' => 'Заголовок не должен превышать 64 символов.',
            'title.regex' => 'Заголовок может содержать только буквы, цифры и специальные символы.',

            'description.string' => 'Описание должно быть строкой.',
            'description.max' => 'Описание не должно превышать 255 символов.',
            'description.regex' => 'Описание может содержать только буквы, цифры и специальные символы.',
        ];
    }

}
