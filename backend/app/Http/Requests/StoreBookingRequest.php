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
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|date_format:d-m-Y',
            'check_out' => 'required|date|date_format:d-m-Y|after:check_in',
            'pets' => 'required|array|min:1|max:4',
            'pets.*' => 'required|string|max:255',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $roomId = $this->input('room_id');
            $checkIn = Carbon::createFromFormat('d-m-Y', $this->input('check_in'))->format('Y-m-d');
            $checkOut = Carbon::createFromFormat('d-m-Y', $this->input('check_out'))->format('Y-m-d');

            if (! (new AvailableBookingDates($roomId, $checkIn, $checkOut))->passes('', '')) {
                $validator->errors()->add('check_in', 'Комната уже забронирована на эту дату.');
            }
        });
    }


    public function messages(): array
    {
        return [
            'room_id.required' => 'Поле "Номер комнаты" обязательно.',
            'room_id.exists' => 'Указанный номер комнаты не найден.',

            'check_in.required' => 'Поле "Дата заезда" обязательно.',
            'check_in.date' => 'Поле "Дата заезда" должно быть корректной датой.',
            'check_in.date_format' => 'Дата заезда должна быть в формате дд-мм-гггг.',

            'check_out.required' => 'Поле "Дата выезда" обязательно.',
            'check_out.date' => 'Поле "Дата выезда" должно быть корректной датой.',
            'check_out.date_format' => 'Дата выезда должна быть в формате дд-мм-гггг.',
            'check_out.after' => 'Дата выезда должна быть позже даты заезда.',

            'pets.required' => 'Укажите хотя бы одного питомца.',
            'pets.array' => 'Поле "Питомцы" должно быть массивом.',
            'pets.min' => 'Необходимо указать хотя бы одного питомца.',
            'pets.max' => 'Можно указать не более 4 питомцев.',

            'pets.*.required' => 'У каждого питомца должно быть указано название.',
            'pets.*.string' => 'Название каждого питомца должно быть строкой.',
            'pets.*.max' => 'Название питомца не должно превышать 255 символов.',
        ];
    }



}
