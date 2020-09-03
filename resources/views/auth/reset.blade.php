@extends('layouts.app')

@section('footer', '')

@section('content')
<form action="{{ Request::fullUrl() }}" method="POST" accept-charset="utf-8">
    <div class="login_container" id="reset">
        <div class="login_block">
            <i class="icon-lock login_i"></i>
            <input type="password" name="password" value="" placeholder="请输入登录密码" class="input login_input" v-model="password">
        </div>
        @csrf
        <button type="sublimt" class="btn login_btn ajax-post" :disabled="disable">重置密码</button>
    </div>
    <div class="white_fixed"></div>
</form>
@endsection

@section('script')
<script type="text/javascript">
    var app = new Vue({
        el: '#reset',
        data: {
            inputPassword: false,
            password: ''
        },
        methods: {
        },
        watch: {
            password: function() {
                var reg = /.{6,32}/;
                if (reg.test(this.password)) {
                    this.inputPassword = true;
                } else {
                    this.inputPassword = false;
                }
            }
        },
        computed: {
            disable: function () {
                return !(this.inputPassword);
            }
        }
    });
</script>
@endsection
