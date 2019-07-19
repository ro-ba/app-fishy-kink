<?php
/*
    入力された文字列が英数字のみであればTrue,でなければFalseを返す
*/

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateUserID implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    

    public function __construct()
    {
        
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
        if(preg_match("/^[a-zA-Z0-9]+$/", $value)){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'IDは英数字しか使用できません';
    }
}
