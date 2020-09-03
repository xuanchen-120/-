@extends('RuLong::layouts.app')

@section('title', 'categories - edit')

@section('content')
<form method="post" action="{{ route('Admin.categories.update', $category) }}" class="form-horizontal">
    <div class="form-group">
        <label class="col-xs-3 control-label">分类名称</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="name" value="{{ $category->name }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">所属模型</label>
        <div class="col-xs-8">
            <select class="form-control" name="type">
                @foreach (config('catetype') as $key => $type)
                <option value="{{ $key }}" @if ($category->type == $key) selected @endif>{{ $type }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">分类排序</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" placeholder="" name="sort" value="{{ $category->sort }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">分类图片</label>
        <div class="col-xs-8">
            @include('Admin::common.webuploader', ['storage' => $category->storage])
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">分类简介</label>
        <div class="col-xs-8">
            <textarea rows="3" class="form-control" name="description" placeholder="">{{ $category->description }}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 col-xs-offset-3">
            @csrf
            @method('put')
            <button class="btn btn-primary ajax-post" type="submit">保存分类</button>
        </div>
    </div>
</form>
@endsection
