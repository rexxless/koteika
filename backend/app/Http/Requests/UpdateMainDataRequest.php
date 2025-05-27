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
            'header' => 'sometimes|array',
            'header.title' => ['nullable', 'string', 'max:64', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u'],
            'header.city' => ['nullable', 'string', 'max:64', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u'],
            'header.slogan' => ['nullable', 'string', 'max:64', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u'],

            'footer' => 'sometimes|array',
            'footer.address' => ['nullable', 'string', 'max:255', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u'],
            'footer.working_time' => ['nullable', 'string', 'max:64', 'regex:/^[0-9-:.\s]+$/u'],
            'footer.phone' => 'nullable|regex:/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/',
            'footer.email' => 'nullable|email',

            // Соцсети как ассоциативный массив: ['vk' => '...', 'instagram' => null]
            'footer.social_links' => 'array|sometimes',
            'footer.social_links.*' => 'nullable|url',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $socialLinks = $this->input('footer.social_links');
            if (is_array($socialLinks)) {
                foreach ($socialLinks as $k => $v) {
                    if (! (new ExistsSocialNetwork($k))->passes('', '')) {
                        $validator->errors()->add('footer.social_links', 'Изменять можно только существующие социальные сети.');
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
            'header.array' => 'Поле "Шапка" должно быть массивом.',

            'header.title.string' => 'Поле "Заголовок" должно быть строкой.',
            'header.title.max' => 'Поле "Заголовок" не должно превышать 64 символов.',
            'header.title.regex' => 'Поле "Заголовок" может содержать только буквы, цифры и специальные символы.',

            'header.city.string' => 'Поле "Город" должно быть строкой.',
            'header.city.max' => 'Поле "Город" не должно превышать 64 символов.',
            'header.city.regex' => 'Поле "Город" может содержать только буквы, цифры и специальные символы.',

            'header.slogan.string' => 'Поле "Слоган" должно быть строкой.',
            'header.slogan.max' => 'Поле "Слоган" не должно превышать 64 символов.',
            'header.slogan.regex' => 'Поле "Слоган" может содержать только буквы, цифры и специальные символы.',

            'footer.array' => 'Поле "Подвал" должно быть массивом.',

            'footer.address.string' => 'Поле "Адрес" должно быть строкой.',
            'footer.address.max' => 'Поле "Адрес" не должно превышать 255 символов.',
            'footer.address.regex' => 'Поле "Адрес" может содержать только буквы, цифры и специальные символы.',

            'footer.working_time.string' => 'Поле "Время работы" должно быть строкой.',
            'footer.working_time.max' => 'Поле "Время работы" не должно превышать 64 символов.',
            'footer.working_time.regex' => 'Поле "Время работы" может содержать только буквы, цифры и специальные символы.',

            'footer.phone.regex' => 'Поле "Телефон" должно быть в формате +7(ХХХ)ХХХ-ХХ-ХХ.',

            'footer.email.email' => 'Поле "Почта" должно быть корректным email-адресом.',

            'footer.social_links.array' => 'Поле "Социальные сети" должно быть ассоциативным массивом.',

            'footer.social_links.*.url' => 'Поле "URL" должно быть корректным URL-адресом.',
        ];
    }
}
