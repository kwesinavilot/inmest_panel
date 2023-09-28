<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MESTDomainOnly implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     * In this case if the person is using an institutional email
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $domain = substr($value, strpos($value, '@') + 1);

        return $domain === "meltwater.org";
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Only institutional email addresses are allowed';
    }
}