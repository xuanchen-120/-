<?php $__env->startSection('title', 'users - edit'); ?>

<?php $__env->startSection('content'); ?>
<form class="form-horizontal" method="post" action="<?php echo e(route('Admin.users.update',$user)); ?>" autocomplete="off">
    <div class="form-group">
        <label class="col-xs-3 control-label">法名</label>
        <div class="col-xs-8">
            <input type="text" placeholder="请填写法名" name="nickname" class="form-control" autocomplete="off" value="<?php echo e($user->info->nickname); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">手机号码</label>
        <div class="col-xs-8">
            <input type="text" placeholder="请填写手机号码" name="username" class="form-control" autocomplete="off" value="<?php echo e($user->username); ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">密码</label>
        <div class="col-xs-8">
            <input type="text" placeholder="请填写密码" name="password" class="form-control" autocomplete="off" value=""  />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">用户头像</label>
        <div class="col-xs-8">
            <?php echo $__env->make('Admin::common.avatar', ['storage' => $user->info->storage], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<div class="form-group">
    <div class="col-xs-offset-3 col-xs-8">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>
        <button class="btn btn-primary ajax-post" type="button">编辑用户</button>
    </div>
</div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>