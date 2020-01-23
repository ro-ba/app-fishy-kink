<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsEqualToString implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(String $value)
    {
        $this->str = $value;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->str == $value){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'パスワードが一致していません。';
    }
}
