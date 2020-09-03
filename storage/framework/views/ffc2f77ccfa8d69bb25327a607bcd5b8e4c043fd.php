<?php $__env->startSection('title', 'banners - create'); ?>

<?php $__env->startSection('content'); ?>
<form method="post" action="<?php echo e(route('Admin.banners.store')); ?>" class="form-horizontal">
    <div class="form-group">
        <label class="col-xs-3 control-label">节点名称</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="name" value="" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">调用标签</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" placeholder="请使用英文标签" name="tag" value="" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">标签简介</label>
        <div class="col-xs-8">
            <textarea rows="3" class="form-control" name="description" placeholder=""></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 col-xs-offset-3">
            <?php echo csrf_field(); ?>
            <button class="btn btn-primary ajax-post" type="submit">保存</button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>