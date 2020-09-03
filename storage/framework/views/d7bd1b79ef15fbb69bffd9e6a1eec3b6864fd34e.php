<?php $__env->startSection('content'); ?>
<form class="form-horizontal" method="post" action="<?php echo e(url()->current()); ?>">
    <div class="form-group">
        <label class="col-xs-3 control-label">原始密码</label>
        <div class="col-xs-8">
            <input type="password" class="form-control" value="" name="oldpass">
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">新的密码</label>
        <div class="col-xs-8">
            <input type="password" class="form-control" value="" name="newpass">
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">重复密码</label>
        <div class="col-xs-8">
            <input type="password" class="form-control" value="" name="repass">
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-8">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <button class="btn btn-primary btn-block ajax-post" type="button">
                <i class="icon icon-check"></i> 确认修改
            </button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>