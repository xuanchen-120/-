<?php

namespace App\Admin\Requests;

class WechatMenuRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:10',
            'type' => 'required',
            'sort' => 'required',
        ];
    }

    /**
     * 获取已定义的验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '菜单名必须填写',
            'name.min'      => '菜单名最少为:min字符',
            'name.max'      => '菜单名最多为:max字符',
            'type.required' => '按钮类型必须填写',
            'sort.required' => '排序必须填写',
        ];
    }
}
