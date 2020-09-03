<?php $__env->startSection('content'); ?>
<!-- 登录 Start -->
<!-- <div class="login_logo"><img src="/assets/home/img/logo.jpg" alt=""></div> -->
<form action="<?php echo e(route('chant.edit',$chant)); ?>" method="POST" accept-charset="utf-8">
    <div class="login_container" >
        <div class="login_block login_margin">
            <i class="icon icon-file-word login_i" style="font-size:1rem"></i>
            <input type="tel" name="number" value="<?php echo e($chant->number); ?>" placeholder="请输入诵经次数" class="input login_input" >
        </div>
        <?php echo csrf_field(); ?>
        <?php echo method_field('post'); ?>
        <button type="sublimt" class="btn login_btn ajax-post" >提交</button>
    </div>
    <div class="white_fixed"></div>
</form>
<!-- 登录 End -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>