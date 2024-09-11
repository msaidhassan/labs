<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoPostKeyword implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the title contains the word "post"
        return stripos($value, 'post') === false;
    }

    public function message()
    {
        return 'The :attribute must not contain the word "post".';
    }
}
