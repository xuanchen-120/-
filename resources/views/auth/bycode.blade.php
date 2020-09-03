@extends('layouts.app')

@section('footer', '')

@section('content')
<!-- 手机验证码登录 Start -->
<div class="login_logo"><img src="/assets/home/img/logo.jpg" alt=""></div>
<form action="{{ url()->current() }}" method="POST" accept-charset="utf-8">
    <div class="login_container" id="bycode">
        <div class="login_block login_margin">
            <i class="icon-mobile login_i" style="font-size:1rem"></i>
            <input type="text" name="mobile" value="" v-model="mobile" placeholder="请输入手机号" class="input login_input">
        </div>
        <div class="login_block">
            <i class="icon-shield login_i"></i>
            <input type="text" name="code" value="" v-model="code" placeholder="请输入验证码" class="input login_input">
            <span class="forget_link"  id="send" @click="sendSmsCode">|&nbsp;获取验证码</span>
        </div>
        @csrf
        <button type="sublimt" class="btn login_btn ajax-post" :disabled="disable">登录</button>
        <div class="login-btm">
            <span class="login-left" @click="window.location.href = '{{ route('register') }}'">注册账号</span>
            <span class="login-right" @click="window.location.href = '{{ route('login') }}'">密码登录</span>
        </div>
    </div>
    <div class="white_fixed"></div>
</form>
<!-- 手机验证码登录 End -->
@endsection

@section('script')
<script type="text/javascript">
    var app = new Vue({
        el: '#bycode',
        data: {
            inputMobile: false,
            inputCode: false,
            codeSend: false,
            mobile: '',
            code: ''
        },
        methods: {
            sendSmsCode: function() {
                $.post("{{ route('auth.sms') }}", {mobile: this.mobile, channel: "BYCODE", '_token': '{{ csrf_token() }}'}, function(res) {
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
                var reg = /^1[3578]{1}[0-9]{9}$|14[57]{1}[0-9]{8}$|^[0][9]\d{8}$/;
                if (reg.test(this.mobile)) {
                    this.inputMobile = true;
                } else {
                    this.inputMobile = false;
                }
            },
            code: function() {
                var reg = /\d{4}/;
                if (reg.test(this.code)) {
                    this.inputCode = true;
                } else {
                    this.inputCode = false;
                }
            }
        },
        computed: {
            disable: function () {
                return !(this.inputMobile && this.inputCode && this.codeSend);
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
