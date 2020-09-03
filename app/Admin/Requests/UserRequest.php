<?php

namespace App\Admin\Requests;

use App\Rules\CheckIdCard;
use App\Rules\CheckMobile;

class UserRequest extends Request
{
    public function rules()
    {
        return [
            'nickname' => 'required',
            'username' => ['required', new CheckMobile, 'unique:users'],
            'idcard'   => ['required', new CheckIdCard],
            'province' => 'required',
            'city'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nickname.required' => '用户姓名必须填写',
            'username.required' => '手机号必须填写',
            'username.unique'   => '手机号已存在',
            'idcard.required'   => '身份证号必须填写',
            'province.required' => '省份必须选择',
            'city.required'     => '城市必须选择',
        ];
    }
}
