<?php $__env->startSection('title', 'banners - create'); ?>

<?php $__env->startSection('content'); ?>
<form method="post" action="<?php echo e(route('Admin.banners.nodeStore', $position)); ?>" class="form-horizontal">
    <div class="form-group">
        <label class="col-xs-3 control-label">数据模型</label>
        <div class="col-xs-8">
            <select class="form-control" name="showable_type">
                <option value="App\Models\Active">活动模型</option>
                <option value="App\Models\Article">文章模型</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">数据主键</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="showable_id" value="" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">banner图</label>
        <div class="col-xs-8">
            <?php echo $__env->make('Admin::common.webuploader', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-8 col-xs-offset-3">
            <?php echo csrf_field(); ?>
            <button class="btn btn-primary ajax-post" type="button">新增轮播</button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>