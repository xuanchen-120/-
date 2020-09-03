<?php $__env->startSection('footer', ''); ?>

<?php $__env->startSection('content'); ?>

<!-- 找回密码 Start -->
<div class="login_logo"><img src="/assets/home/img/logo.jpg" alt=""></div>
<form action="<?php echo e(url()->current()); ?>" method="POST" accept-charset="utf-8">
    <div class="login_container" id="forgot">
        <div class="login_block login_margin">
            <i class="icon-mobile login_i" style="font-size:1rem"></i>
            <input type="tel" name="mobile" value="" placeholder="请输入手机号" class="input login_input" v-model="mobile">
        </div>
        <div class="login_block">
            <i class="icon-shield login_i"></i>
            <input type="text" name="code" value="" placeholder="请输入验证码" class="input login_input" v-model="code">
            <span class="forget_link" @click="send" :disabled="!inputMobile">|&nbsp;获取验证码</span>
        </div>
        <?php echo csrf_field(); ?>
        <button type="sublimt" class="btn login_btn ajax-post" :disabled="disable">确定</button>
        <div class="login-btm">
            <span class="login-left" @click="window.location.href = '<?php echo e(route('register')); ?>'" >注册账号</span>
            <span class="login-right" @click="window.location.href = '<?php echo e(route('login.bycode')); ?>'" >手机验证码登录</span>
        </div>
    </div>
    <div class="white_fixed"></div>
</form>
<!-- 找回密码 End -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    var app = new Vue({
        el: '#forgot',
        data: {
            inputMobile: false,
            inputCode: false,
            codeSend: false,
            mobile: '',
            code: ''
        },
        methods: {
            send: function() {
                $.post("<?php echo e(route('auth.sms')); ?>", {mobile: this.mobile, channel: "FORGOT", '_token': '<?php echo e(csrf_token()); ?>'}, function(res) {
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
                var reg = /^1[356789]{1}[0-9]{9}$|14[57]{1}[0-9]{8}$|^[0][9]\d{8}$/;
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>