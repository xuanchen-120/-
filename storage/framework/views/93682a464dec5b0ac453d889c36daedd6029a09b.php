<?php $__env->startSection('title', 'admins - create'); ?>

<?php $__env->startSection('content'); ?>
<form class="form-horizontal" method="post" action="<?php echo e(route('RuLong.admins.store')); ?>">
    <div class="form-group">
        <label class="col-xs-3 control-label">用户名</label>
        <div class="col-xs-8">
            <input type="text" placeholder="登录用户名" name="username" class="form-control" value="" autocomplete="off" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">登录密码</label>
        <div class="col-xs-8">
            <input type="text" placeholder="登录密码" name="password" class="form-control" value="" autocomplete="off" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">用户昵称</label>
        <div class="col-xs-8">
            <input type="text" placeholder="用户昵称" name="nickname" class="form-control" value="" autocomplete="off" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-8">
            <?php echo csrf_field(); ?>
            <button class="btn btn-primary ajax-post" type="button">新增用户</button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>