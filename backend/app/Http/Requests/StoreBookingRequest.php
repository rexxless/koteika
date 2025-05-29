<?php

namespace App\Http\Requests;

use App\Rules\AvailableBookingDates;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class StoreBookingRequest extends FormRequest
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
            'check_in' => 'required|', // Нет проверки на корректность даты, т.к. она ниже
            'check_out' => 'required|after:check_in', // Нет проверки на корректность даты, т.к. она ниже
            'pets' => 'required|array|min:1|max:4',
            'pets.*' => ['required', 'string', 'max:64', 'regex:/^[A-Za-zА-Яа-яЁё0-9!@#$%^&*()_+\-=\{};\':"|,.<>\/?\s]+$/u'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Получаем данные
            $roomId = $this->input('room_id');
            $checkIn = $this->input('check_in');
            $checkOut = $this->input('check_out');

            // Проверяем, что даты корректны
            if (!preg_match('/\d{2}-\d{2}-\d{4}/', $checkIn)) {
                $validator->errors()->add('check_in', 'Дата заезда указана неверно. Формат: дд-мм-гггг.');
                return;
            }

            if (!preg_match('/\d{2}-\d{2}-\d{4}/', $checkOut)) {
                $validator->errors()->add('check_out', 'Дата выезда указана неверно. Формат: дд-мм-гггг.');
                return;
            }

            // Теперь можно безопасно использовать Carbon
            try {
                $carbonCheckIn = Carbon::createFromFormat('d-m-Y', $checkIn)->toDateString();
                $carbonCheckOut = Carbon::createFromFormat('d-m-Y', $checkOut)->toDateString();

                if (!(new AvailableBookingDates($roomId, $carbonCheckIn, $carbonCheckOut))->passes('', '')) {
                    $validator->errors()->add('check_in', 'Комната уже забронирована на эту дату.');
                }
            } catch (\Exception $e) {
                $validator->errors()->add('check_in', 'Невозможно обработать дату. Убедитесь, что дата в правильном формате.');
            }
        });
    }


    public function messages(): array
    {
        return [
            'check_in.required' => 'Поле check_in обязательно.',
            'check_in.date' => 'Поле check_in должно быть корректной датой.',
            'check_in.date_format' => 'Дата заезда должна быть в формате дд-мм-гггг.',

            'check_out.required' => 'Поле check_out обязательно.',
            'check_out.date' => 'Поле check_out должно быть корректной датой.',
            'check_out.date_format' => 'Дата выезда должна быть в формате дд-мм-гггг.',
            'check_out.after' => 'Дата выезда должна быть позже даты заезда.',

            'pets.required' => 'Укажите хотя бы одного питомца.',
            'pets.array' => 'Поле pets должно быть массивом.',
            'pets.min' => 'Необходимо указать хотя бы одного питомца.',
            'pets.max' => 'Можно указать не более 4 питомцев.',

            'pets.*.required' => 'У каждого питомца должно быть указано название.',
            'pets.*.string' => 'Название каждого питомца должно быть строкой.',
            'pets.*.max' => 'Название питомца не должно превышать 64 символов.',
            'pets.*.regex' => 'Название питомца может содержать только буквы, цифры и специальные символы.',
        ];
    }
}
