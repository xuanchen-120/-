

<?php $__env->startSection('footer', ''); ?>

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(Request::fullUrl()); ?>" method="POST" accept-charset="utf-8">
    <div class="login_container" id="reset">
        <div class="login_block">
            <i class="icon-lock login_i"></i>
            <input type="password" name="password" value="" placeholder="请输入登录密码" class="input login_input" v-model="password">
        </div>
        <?php echo csrf_field(); ?>
        <button type="sublimt" class="btn login_btn ajax-post" :disabled="disable">重置密码</button>
    </div>
    <div class="white_fixed"></div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>