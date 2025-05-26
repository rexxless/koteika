<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StorePhotoRequest extends FormRequest
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
            'photos' => ['sometimes', 'array', 'max:5'],
            'photos.*' => ['image', 'mimes:jpeg,png', 'max:2048'], // размер в КБ
        ];
    }

    public function messages(): array
    {
        return [
            'photos.array' => 'Поле photos должно быть массивом.',
            'photos.max' => 'Можно загрузить не более 5 фотографий.',
            'photos.*.image' => 'Каждый файл должен быть изображением.',
            'photos.*.mimes' => 'Фотографии должны быть в формате jpeg или png.',
            'photos.*.max' => 'Размер каждой фотографии не должен превышать 2 МБ.',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function () use ($validator) {
            // Получаем комнату из роута
            $room = $this->route('room');

            if (!$room) {
                $validator->errors()->add('room', 'Комната не найдена.');
                return;
            }

            // Проверяем, что 'photos' загружены
            $photos = $this->file('photos');

            if (is_null($photos)) {
                return; // нет файлов — выходим
            }

            // Если передан один файл, оборачиваем в массив
            $photosArray = is_array($photos) ? $photos : [$photos];

            $newPhotosCount = count($photosArray);

            // Получаем текущее количество фото у комнаты
            $existingPhotosCount = $room->photos()->count();

            if ($existingPhotosCount + $newPhotosCount > 5) {
                $validator->errors()->add(
                    'photos',
                    'Нельзя загрузить больше 5 фото для одной комнаты.'
                );
            }
        });
    }
}
