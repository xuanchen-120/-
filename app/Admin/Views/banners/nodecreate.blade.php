@extends('RuLong::layouts.app')

@section('title', 'banners - create')

@section('content')
<form method="post" action="{{ route('Admin.banners.nodeStore', $position) }}" class="form-horizontal">
    <div class="form-group">
        <label class="col-xs-3 control-label">数据模型</label>
        <div class="col-xs-8">
            <select class="form-control" name="showable_type">
                <option value="App\Models\Active">活动模型</option>
                <option value="App\Models\Article">文章模型</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">数据主键</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="showable_id" value="" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">banner图</label>
        <div class="col-xs-8">
            @include('Admin::common.webuploader')
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-8 col-xs-offset-3">
            @csrf
            <button class="btn btn-primary ajax-post" type="button">新增轮播</button>
        </div>
    </div>
</form>
@endsection
