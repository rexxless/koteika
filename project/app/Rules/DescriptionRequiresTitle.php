<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class DescriptionRequiresTitle implements Rule
{
    protected $title;
    protected $description;

    public function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }
    public function passes($attribute, $value): bool
    {
        if (!isset($this->title) && isset($this->description)) {
            return false;
        } return true;
    }

    public function message()
    {
        return 'Введите заголовок отзыва.';
    }
}
