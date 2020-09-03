<?php $__env->startSection('footer', ''); ?>
<?php $__env->startSection('content'); ?>
<!-- 登录 Start -->
<div class="login_logo"><img src="/assets/home/img/logo.jpg" alt=""></div>
<form action="<?php echo e(url()->current()); ?>" method="POST" accept-charset="utf-8">
    <div class="login_container" id="login">
        <div class="login_block login_margin">
            <i class="icon-mobile login_i" style="font-size:1rem"></i>
            <input type="tel" name="username" value="" placeholder="请输入手机号" class="input login_input" v-model="mobile">
        </div>
        <div class="login_block">
            <i class="icon-lock login_i"></i>
            <input type="password" name="password" value="" placeholder="请输入登录密码" class="input login_input" v-model="password">
            <!-- <span class="forget_link" @click="window.location.href = '<?php echo e(route('forgot')); ?>'">忘记密码？</span> -->
        </div>
        <button type="sublimt" class="btn login_btn ajax-post" :disabled="disable">登录</button>
        <div class="login-btm">
            <span class="login-left" @click="window.location.href = '<?php echo e(route('register')); ?>'" >注册账号</span>
        </div>
        <?php echo csrf_field(); ?>
       
    </div>
    <div class="white_fixed"></div>
</form>
<!-- 登录 End -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    var app = new Vue({
        el: '#login',
        data: {
            inputMobile: false,
            inputPassword: false,
            mobile: '',
            password: ''
        },
        methods: {
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
                return !(this.inputMobile && this.inputPassword);
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>