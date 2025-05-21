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
            'header.title' => 'nullable|string|max:255',
            'header.city' => 'nullable|string|max:255',
            'header.slogan' => 'nullable|string|max:255',

            'footer' => 'sometimes|array',
            'footer.address' => 'nullable|string',
            'footer.working_time' => 'nullable|string|max:255',
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
            foreach ($this->input('footer.social_links') as $k => $v) {
                if (! (new ExistsSocialNetwork($k))->passes('', '')) {
                    $validator->errors()->add('footer.social_links', 'Изменять можно только существующие социальные сети.');
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
            'header.array' => 'Поле "header" должно быть массивом.',

            'header.title.string' => 'Поле "title" должно быть строкой.',
            'header.title.max' => 'Поле "title" не должно превышать 255 символов.',

            'header.city.string' => 'Поле "city" должно быть строкой.',
            'header.city.max' => 'Поле "city" не должно превышать 255 символов.',

            'header.slogan.string' => 'Поле "slogan" должно быть строкой.',
            'header.slogan.max' => 'Поле "slogan" не должно превышать 255 символов.',


            'footer.array' => 'Поле "footer" должно быть массивом.',

            'footer.address.string' => 'Поле "address" должно быть строкой.',

            'footer.working_time.string' => 'Поле "working_time" должно быть строкой.',
            'footer.working_time.max' => 'Поле "working_time" не должно превышать 255 символов.',

            'footer.phone.regex' => 'Телефон должен быть в формате +7(ХХХ)ХХХ-ХХ-ХХ.',

            'footer.email.email' => 'Поле "email" должно быть корректным email-адресом.',

            'footer.social_links.array' => 'Поле "social_networks" должно быть ассоциативным массивом.',

            'footer.social_links.*.url' => 'Значение должно быть корректным URL.',
        ];
    }
}
