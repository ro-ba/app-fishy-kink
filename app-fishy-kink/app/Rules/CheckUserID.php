<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckUserID implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

     protected $db = [];
     protected $userID = '';

    public function __construct($db,$userID)
    {
        $this->db = $db;
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
        if($this -> data["userDB"]->findOne(["userID" => $value])){
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
        return 'ユーザIDが間違っているか登録されていません';
    }
}
