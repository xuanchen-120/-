@extends('layouts.app')

@section('footer', '')

@section('content')
<!-- 注册 Start -->
<div class="login_logo"><img src="/assets/home/img/logo.jpg" alt=""></div>
<form action="" method="get" accept-charset="utf-8">
    <div class="login_container" id="register">
        <div class="login_block login_margin">
            <i class="icon-mobile login_i" style="font-size:1rem"></i>
            <input type="number" name="username" value="" v-model="mobile" placeholder="输入手机号" class="input login_input">
        </div>
        <div class="login_block login_margin">
            <i class="icon-mobile login_i" ></i>
            <input type="text" name="nickname" value="" v-model="nickname" placeholder="输入共修报数名" class="input login_input">
        </div>
        <div class="login_block login_margin">
            <i class="icon-lock login_i"></i>
            <input type="password" name="password" value="" placeholder="输入密码" class="input login_input">
        </div>
        <div class="login_block login_margin">
            <i class="icon-lock login_i"></i>
            <input type="password" name="password_confirmation" value="" placeholder="确认密码" class="input login_input">
        </div>
        @csrf
        <button type="sublimt" class="btn login_btn ajax-post" :disabled="disable">注册</button>
        <div class="login-btm">
            <span class="login-left" @click="window.location.href = '{{ route('login') }}'">密码登录</span>
        </div>
    </div>
    <div class="white_fixed"></div>
</form>
<!-- 注册 End -->
@endsection

@section('script')
<script type="text/javascript">
    var app = new Vue({
        el: '#register',
        data: {
            inputMobile: false,
            inputNickname: false,
            mobile: '',
            nickname: '',
        },
        methods: {
            sendSmsCode: function() {
                $.post("{{ route('auth.sms') }}", {mobile: this.mobile, channel: "DEFAULT", '_token': '{{ csrf_token() }}'}, function(res) {
                    if (res.statusCode == 200) {
                        updateAlert(res.message);
                        settime($('#send'));
                        app.codeSend = true;
                    } else {
                        updateAlert(res.message);
                    }
                });
            }
        },
        watch: {
            mobile: function() {
                var reg = /^1[3456789]{1}[0-9]{9}$|14[57]{1}[0-9]{8}$|^[0][9]\d{8}$/;
                if (reg.test(this.mobile)) {
                    this.inputMobile = true;
                } else {
                    this.inputMobile = false;
                }
            },
            nickname: function() {
                if (this.nickname.length==0) {
                    this.inputNickname = false;
                }else{
                    this.inputNickname = true;
                }
            },

            code: function() {
                var reg = /\d{4}/;
                if (reg.test(this.code)) {
                    this.inputCode = true;
                } else {
                    this.inputCode = false;
                }
            },
        },
        computed: {
            disable: function () {
                return !(this.inputMobile && this.inputNickname);
            }
        }
    });

    var countdown = 60;
    function settime(obj) {
        if (countdown == 0) {
            obj.removeAttr("disabled");
            obj.html("获取验证码");
            countdown = 60;
            return;
        } else {
            obj.attr("disabled", true);
            obj.html("重新发送(" + countdown + ")");
            countdown--;
        }
        setTimeout(function() {
            settime(obj)
        }, 1000)
    }
</script>
@endsection
