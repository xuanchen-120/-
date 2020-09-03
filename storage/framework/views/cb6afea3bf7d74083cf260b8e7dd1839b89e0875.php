<?php $__env->startSection('title', 'roles - edit'); ?>

<?php $__env->startSection('content'); ?>
<form class="form-horizontal" method="post" action="<?php echo e(route('RuLong.roles.update', $role)); ?>">
    <div class="form-group">
        <label class="col-xs-3 control-label">角色名称</label>
        <div class="col-xs-8">
            <input type="text" placeholder="角色名称" name="name" class="form-control" value="<?php echo e($role->name); ?>" autocomplete="off" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">备注信息</label>
        <div class="col-xs-8">
            <textarea name="description" class="form-control" rows="3"><?php echo e($role->description); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-8">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <button class="btn btn-primary ajax-post" type="button">保存角色</button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>