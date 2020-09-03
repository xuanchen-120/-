<?php

namespace App\Admin\Requests;

class CategoryRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:20',
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
            'name.required' => '分类名称必须填写',
            'name.min'      => '分类名称最少为:min字符',
            'name.max'      => '分类名称最多为:max字符',
        ];
    }
}
