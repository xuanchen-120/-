<?php $__env->startSection('footer', ''); ?>

<?php $__env->startSection('content'); ?>
<form method="post" action="<?php echo e(route('setting.info', ['user' => $user, 'field' => $field])); ?>">
    <div class="login_container" id="reset">
        <div class="login_block">
            <i class="icon-lock login_i"></i>
            <input type="text" name="<?php echo e($field); ?>" class="input login_input" placeholder="<?php echo e($placeholder); ?>" value="<?php echo e($user->info->$field ?? ''); ?>" autofocus="autofocus">
        </div>
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>
        <button type="button" class="btn login_btn ajax-post">保存</button>
    </div>
    <div class="white_fixed"></div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>