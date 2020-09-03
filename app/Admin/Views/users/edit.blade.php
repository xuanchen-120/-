@extends('RuLong::layouts.app')

@section('title', 'users - edit')

@section('content')
<form class="form-horizontal" method="post" action="{{ route('Admin.users.update',$user) }}" autocomplete="off">
    <div class="form-group">
        <label class="col-xs-3 control-label">法名</label>
        <div class="col-xs-8">
            <input type="text" placeholder="请填写法名" name="nickname" class="form-control" autocomplete="off" value="{{ $user->info->nickname }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">手机号码</label>
        <div class="col-xs-8">
            <input type="text" placeholder="请填写手机号码" name="username" class="form-control" autocomplete="off" value="{{ $user->username }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">密码</label>
        <div class="col-xs-8">
            <input type="text" placeholder="请填写密码" name="password" class="form-control" autocomplete="off" value=""  />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">用户头像</label>
        <div class="col-xs-8">
            @include('Admin::common.avatar', ['storage' => $user->info->storage])
        </div>
    </div>

<div class="form-group">
    <div class="col-xs-offset-3 col-xs-8">
        @csrf
        @method('put')
        <button class="btn btn-primary ajax-post" type="button">编辑用户</button>
    </div>
</div>
</form>
@endsection
