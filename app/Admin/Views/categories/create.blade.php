@extends('RuLong::layouts.app')

@section('title', 'categories - create')

@section('content')
<form method="post" action="{{ route('Admin.categories.store') }}" class="form-horizontal">
    <div class="form-group">
        <label class="col-xs-3 control-label">分类名称</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="name" value="" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">所属模型</label>
        <div class="col-xs-8">
            <select class="form-control" name="type">
                @foreach (config('catetype') as $key => $type)
                <option value="{{ $key }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">分类图片</label>
        <div class="col-xs-8">
            @include('Admin::common.webuploader')
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">分类排序</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" placeholder="" name="sort" value="0" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">分类简介</label>
        <div class="col-xs-8">
            <textarea rows="3" class="form-control" name="description" placeholder=""></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 col-xs-offset-3">
            @csrf
            <button class="btn btn-primary ajax-post" type="submit">保存分类</button>
        </div>
    </div>
</form>
@endsection
