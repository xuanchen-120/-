@extends('RuLong::layouts.app')

@section('title', 'banners - create')

@section('content')
<form method="post" action="{{ route('Admin.banners.update', $banner) }}" class="form-horizontal">
    <div class="form-group">
        <label class="col-xs-3 control-label">节点名称</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="name" value="{{ $banner->name ?? '' }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">调用标签</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" placeholder="请使用英文标签" name="tag" value="{{ $banner->tag ?? '' }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">标签简介</label>
        <div class="col-xs-8">
            <textarea rows="3" class="form-control" name="description" placeholder="">{{ $banner->description ?? '' }}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 col-xs-offset-3">
            @csrf
            @method('put')
            <button class="btn btn-primary ajax-post" type="submit">修改</button>
        </div>
    </div>
</form>
@endsection
