@extends('layouts.app')

@section('title', '个人设置')


@section('content')
<div class="content">
    <ul class="install">
        <li class="installFile">
            <span>头像</span>
            <input type="file" id="file" accept="image/*">
            <div class="installIcon" id="show">
                <img src="{{ $user->info->head_img }}">
            </div>
            <i class="icon icon-angle-right"></i>
        </li>
        <li>
            <span>共修报数名</span>
            <div class="installIcon" data-href="{{ route('setting.info', ['user' => $user, 'field' => 'nickname']) }}">
                <span>{{ $user->info->nickname ?? '' }}</span>
            </div>
            <i class="icon icon-angle-right"></i>
        </li>
        <li>
            <span>手机号</span>
            <div class="installIcon" style="width: calc(100% - 3.5rem)">
                <span class="immutable">{{ $user->username ?? '' }}</span>
            </div>
        </li>

        <li>
            <span>修改密码</span>
            <div class="installIcon" data-href="{{ route('settings.password') }}">
            </div>
            <i class="icon icon-angle-right"></i>
        </li>
    </ul>
</div>
@endsection

@section('script')
<script type="text/javascript" src="/assets/home/js/lrz.all.bundle.js"></script>
<script type="text/javascript">
    $('#show').click(function(event){
        $('#file').click();
    });
    $('#file').change(function(event){
        var $this = $(this);
        lrz(this.files[0], {
            width: 640,
            fieldName: 'image'
        }).then(function(rst) {
            $('#show img').attr('src', rst.base64);
            return rst;
        }).then(function(rst) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', "{{ route('storages.picture') }}?_token={{ csrf_token() }}", true);
            xhr.onload = function () {
                var data = $.parseJSON(xhr.responseText);
                if (data.code == 1) {
                    $.post("{{ route('setting.avatar', $user) }}?_token={{ csrf_token() }}", { avatar:data.path }, function(json){
                        if(json.status == 'SUCCESS'){
                            updateAlert(json.message);
                        } else {
                            updateAlert(json.message);
                        }
                    });
                } else {
                    updateAlert(data.message);
                }
            };
            xhr.onerror = function () {
            };
            xhr.send(rst.formData);
            return rst;
        }).catch(function (err) {
            updateAlert(err);
        }).always(function () {
            // 不管是成功失败，这里都会执行
        });
    });
</script>
@endsection
