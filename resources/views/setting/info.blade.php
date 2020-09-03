@extends('layouts.app')

@section('footer', '')

@section('content')
<form method="post" action="{{ route('setting.info', ['user' => $user, 'field' => $field]) }}">
    <div class="login_container" id="reset">
        <div class="login_block">
            <i class="icon-lock login_i"></i>
            <input type="text" name="{{ $field }}" class="input login_input" placeholder="{{ $placeholder }}" value="{{ $user->info->$field ?? '' }}" autofocus="autofocus">
        </div>
        @csrf
        @method('put')
        <button type="button" class="btn login_btn ajax-post">保存</button>
    </div>
    <div class="white_fixed"></div>
</form>
@endsection
