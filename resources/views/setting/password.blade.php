@extends('layouts.app')

@section('footer', '')

@section('content')
<!-- 注册 Start -->
<form action="" method="get" accept-charset="utf-8">
    <div class="login_container" id="register">
        <div class="login_block login_margin">
            <i class="icon-lock login_i" ></i>
            <input type="text" name="old_password" value="" v-model="nickname" placeholder="请输入原密码" class="input login_input">
        </div>
        <div class="login_block login_margin">
            <i class="icon-lock login_i"></i>
            <input type="password" name="password" value="" placeholder="请输入新密码" class="input login_input">
        </div>
        <div class="login_block login_margin">
            <i class="icon-lock login_i"></i>
            <input type="password" name="password_confirmation" value="" placeholder="请输入确认密码" class="input login_input">
        </div>
        @csrf
        @method('PUT')
        <button type="sublimt" class="btn login_btn ajax-post" :disabled="disable">修改</button>
    </div>
    <div class="white_fixed"></div>
</form>
<!-- 注册 End -->
@endsection
