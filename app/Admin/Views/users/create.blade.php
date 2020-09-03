@extends('RuLong::layouts.app')

@section('title', 'users - create')

@push('script')
<script type="text/javascript">
    $('body').on('change', '#province', function(event){
        var psn = $(this).find('option').not(function() {return !this.selected}).attr('data-id');
        $.post('{{ route("Admin.ajaxs.getcities") }}?_token={{ csrf_token() }}', {psn: psn}, function(data){
            $('#city').empty();
            var str = '';
            if (data.code == 1) {
                for (var second in data.data)
                {
                    str +='<option value="' + data.data[second].shortname + '">' + data.data[second].name + '</option>';
                }
                $('#city').append(str);
            } else {
                updateAlert('获取失败');
            }
        });
    });
</script>
@endpush

@section('content')
<form class="form-horizontal" method="post" action="{{ route('Admin.users.store') }}" autocomplete="off">
    <div class="form-group">
        <label class="col-xs-3 control-label">用户姓名</label>
        <div class="col-xs-8">
            <input type="text" placeholder="请填写用户姓名" name="nickname" class="form-control" autocomplete="off" value="" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">手机号码</label>
        <div class="col-xs-8">
            <input type="text" placeholder="请填写手机号码" name="username" class="form-control" autocomplete="off" value="" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">身份证号</label>
        <div class="col-xs-8">
            <input type="text" placeholder="请填写用户身份证号" name="idcard" class="form-control" autocomplete="off" value="" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">国家</label>
        <div class="col-xs-8">
            <input type="text" placeholder="请填写国家" name="country" class="form-control" autocomplete="off" value="中国" readonly="readonly" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">省份</label>
        <div class="col-xs-8">
            <select class="form-control" name="province" id="province">
                <option value="">--请选择省份--</option>
                @foreach($areas as $area)
                <option value="{{ $area->shortname }}" data-id="{{ $area->sn }}">{{ $area->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">城市</label>
        <div class="col-xs-8">
            <select class="form-control" name="city" id="city">
                <option value="">--请选择城市--</option>
            </select>
        </div>
    </div>
    {{-- <div class="form-group">
        <label class="col-xs-3 control-label">登录密码</label>
        <div class="col-xs-8">
            <input type="text" placeholder="请填写登录密码" name="password" class="form-control" autocomplete="off" value="123456" readonly="readonly" />
        </div>
    </div> --}}
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-8">
            @csrf
            <button class="btn btn-primary ajax-post" type="button">新增用户</button>
        </div>
    </div>
</form>
@endsection
