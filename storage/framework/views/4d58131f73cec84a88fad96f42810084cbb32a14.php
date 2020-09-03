<?php $__env->startSection('title', 'categories - create'); ?>

<?php $__env->startSection('content'); ?>
<form method="post" action="<?php echo e(route('Admin.categories.store')); ?>" class="form-horizontal">
    <div class="form-group">
        <label class="col-xs-3 control-label">分类名称</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="name" value="" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">所属模型</label>
        <div class="col-xs-8">
            <select class="form-control" name="type">
                <?php $__currentLoopData = config('catetype'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key); ?>"><?php echo e($type); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">分类图片</label>
        <div class="col-xs-8">
            <?php echo $__env->make('Admin::common.webuploader', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">分类排序</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" placeholder="" name="sort" value="0" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">分类简介</label>
        <div class="col-xs-8">
            <textarea rows="3" class="form-control" name="description" placeholder=""></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 col-xs-offset-3">
            <?php echo csrf_field(); ?>
            <button class="btn btn-primary ajax-post" type="submit">保存分类</button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>