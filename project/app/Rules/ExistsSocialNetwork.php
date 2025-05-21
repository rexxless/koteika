<?php

namespace App\Rules;

use App\Models\SocialLink;
use Closure;
use Illuminate\Contracts\Validation\Rule;

class ExistsSocialNetwork implements Rule
{
    private $socialNetwork;

    public function __construct($socialNetwork)
    {
        $this->socialNetwork = $socialNetwork;
    }
    public function passes($attribute, $value): bool
    {
        $socialLinks = SocialLink::all()->toArray();
        foreach ($socialLinks as $socialLink) {
            if ($socialLink['social_network'] == $this->socialNetwork) {
                return true;
            }
        }
        return false;
    }

    public function message(): string
    {
        return 'Изменять можно только существующие социальные сети.';
    }
}
