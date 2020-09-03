<?php

namespace App\Admin\Requests;

class ArticleRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'required|min:2|max:200',
            'category_id' => 'required|integer|min:1',
            'storage_id'  => 'required',
            // 'description' => 'required|min:2|max:140',
            'content'     => 'required',
            // 'status'      => 'required',
            // 'sort'        => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'       => '标题不能为空',
            'title.min'            => '标题不能少于:min个汉字',
            'title.max'            => '标题不能多于:max个汉字',
            'storage_id.required'  => '请上传图片',
            'category_id.required' => '请选择分类',
            'category_id.min'      => '请选择分类',
            'category_id.integer'  => '分类数据错误',
            'description.required' => '简介不能为空',
            'description.min'      => '简介不能少于:min个汉字',
            'description.max'      => '简介不能多于:max个汉字',
            'content.required'     => '内容不能为空',
            'status.required'      => '请选择状态',
            'sort.required'        => '排序不能为空',
        ];
    }
}
