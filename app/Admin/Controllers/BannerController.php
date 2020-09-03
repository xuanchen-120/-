<?php

namespace App\Admin\Controllers;

use App\Models\Banner;
use App\Models\BannerPosition;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $positions = BannerPosition::when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        })->orderBy('id', 'desc')->paginate();

        return view('Admin::banners.index', compact('positions'));
    }

    public function create()
    {
        return view('Admin::banners.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'tag'  => 'required|alpha|unique:banner_positions',
        ], [
            'name.required' => '节点名称必须填写',
            'tag.required'  => '调用标签必须填写',
            'tag.alpha'     => '调用标签格式不正确',
            'tag.unique'    => '调用标签已存在',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), '', '');
        }

        $result = BannerPosition::create($request->all());
        if ($result) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function edit(BannerPosition $banner)
    {
        return view('Admin::banners.edit', compact('banner'));
    }

    public function update(BannerPosition $banner, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'tag'  => ['required', 'alpha', Rule::unique('banner_positions')->ignore($banner->id)],
        ], [
            'name.required' => '节点名称必须填写',
            'tag.required'  => '调用标签必须填写',
            'tag.alpha'     => '调用标签格式不正确',
            'tag.unique'    => '调用标签已存在',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), '', '');
        }

        $result = $banner->update($request->all());
        if ($result) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function destroy(BannerPosition $banner)
    {
        if ($banner->delete()) {
            $banner->banners()->delete();
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function show(BannerPosition $banner)
    {
        $banners  = $banner->banners()->paginate();
        $position = $banner;
        return view('Admin::banners.show', compact('banners', 'position'));
    }

    public function nodeCreate(BannerPosition $position)
    {
        return view('Admin::banners.nodecreate', compact('position'));
    }

    public function nodeStore(BannerPosition $position, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'showable_type' => 'required',
            'showable_id'   => 'required|integer',
        ], [
            'showable_type.required' => '数据模型必须选择',
            'showable_id.required'   => '数据主键必须填写',
            'showable_id.integer'    => '数据主键格式不正确',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), '', '');
        }

        $result = $position->banners()->create($request->all());
        if ($result) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function nodeDelete(Banner $banner)
    {
        if ($banner->delete()) {
            return $this->success();
        } else {
            return $this->error();
        }
    }
}
