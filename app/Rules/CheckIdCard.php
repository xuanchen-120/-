<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckIdCard implements Rule
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
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $cardNo)
    {
        if (strlen($cardNo) != 18) {
            return false;
        }

        $idcard_base = substr($cardNo, 0, 17);
        $verify_code = substr($cardNo, 17, 1);

        $factor      = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
        $verify_list = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];

        $total = 0;
        for ($i = 0; $i < 17; $i++) {
            $total += substr($idcard_base, $i, 1) * $factor[$i];
        }
        $mod = $total % 11;

        if ($verify_code == $verify_list[$mod]) {
            return true;
        } else {
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
        return '身份证号格式不正确';
    }
}
