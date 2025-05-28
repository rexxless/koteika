<?php

namespace App\Http\Requests;

use App\Models\SocialLink;
use App\Rules\ExistsSocialNetwork;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateMainDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $allowedNetworks = SocialLink::query()->get('social_network')->toArray();
        return [
            'title' => ['nullable', 'string', 'max:64', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u'],
            'city' => ['nullable', 'string', 'max:64', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u'],
            'slogan' => ['nullable', 'string', 'max:64', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u'],

            'address' => ['nullable', 'string', 'max:255', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u'],
            'working_time' => ['nullable', 'string', 'max:64', 'regex:/^[А-Яа-яЁё0-9()_\'"\s]+$/u'],
            'phone' => 'nullable|regex:/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/',
            'email' => 'nullable|email',

            // Соцсети как ассоциативный массив: ['vk' => '...', 'instagram' => null]
            'social_links' => 'array|sometimes',
            'social_links.*' => 'nullable|url',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $socialLinks = $this->input('social_links');
            if (is_array($socialLinks)) {
                foreach ($socialLinks as $k => $v) {
                    if (! (new ExistsSocialNetwork($k))->passes('', '')) {
                        $validator->errors()->add('social_links', 'Изменять можно только существующие социальные сети.');
                    }
                }
            }
        });
    }

    /**
     * Получить сообщения об ошибках для определённых правил проверки.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.string' => 'Поле title должно быть строкой.',
            'title.max' => 'Поле title не должно превышать 64 символов.',
            'title.regex' => 'Поле title может содержать только буквы, цифры и специальные символы.',

            'city.string' => 'Поле city должно быть строкой.',
            'city.max' => 'Поле city не должно превышать 64 символов.',
            'city.regex' => 'Поле city может содержать только буквы, цифры и специальные символы.',

            'slogan.string' => 'Поле slogan должно быть строкой.',
            'slogan.max' => 'Поле slogan не должно превышать 64 символов.',
            'slogan.regex' => 'Поле slogan может содержать только буквы, цифры и специальные символы.',

            'address.string' => 'Поле address должно быть строкой.',
            'address.max' => 'Поле address не должно превышать 255 символов.',
            'address.regex' => 'Поле address может содержать только буквы, цифры и специальные символы.',

            'working_time.string' => 'Поле working_time должно быть строкой.',
            'working_time.max' => 'Поле working_time не должно превышать 64 символов.',
            'working_time.regex' => 'Поле working_time может содержать только кириллические буквы, цифры и скобки, нижнее подчеркивание и кавычки.',

            'phone.regex' => 'Поле phone должно быть в формате +7(ХХХ)ХХХ-ХХ-ХХ.',

            'email.email' => 'Поле email должно быть корректным email-адресом.',

            'social_links.array' => 'Поле social_links должно быть ассоциативным массивом.',

            'social_links.*.url' => 'Поле url должно быть корректным URL-адресом.',
        ];
    }
}
