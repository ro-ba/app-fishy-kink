<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateUserID implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    protected $data = ["tetetetete"];

    public function __construct(array &$data)
    {
        $this->data = $data;
    }

    // public function __construct()
    // {
    //     //
    // }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this -> data["userDB"]->findOne(["userID" => $value])){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'このIDは使われています';
    }
}
