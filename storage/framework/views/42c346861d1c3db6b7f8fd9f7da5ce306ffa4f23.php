<?php $__env->startSection('title', 'categories - edit'); ?>

<?php $__env->startSection('content'); ?>
<form method="post" action="<?php echo e(route('Admin.categories.update', $category)); ?>" class="form-horizontal">
    <div class="form-group">
        <label class="col-xs-3 control-label">分类名称</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="name" value="<?php echo e($category->name); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">所属模型</label>
        <div class="col-xs-8">
            <select class="form-control" name="type">
                <?php $__currentLoopData = config('catetype'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key); ?>" <?php if($category->type == $key): ?> selected <?php endif; ?>><?php echo e($type); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">分类排序</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" placeholder="" name="sort" value="<?php echo e($category->sort); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">分类图片</label>
        <div class="col-xs-8">
            <?php echo $__env->make('Admin::common.webuploader', ['storage' => $category->storage], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">分类简介</label>
        <div class="col-xs-8">
            <textarea rows="3" class="form-control" name="description" placeholder=""><?php echo e($category->description); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 col-xs-offset-3">
            <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?>
            <button class="btn btn-primary ajax-post" type="submit">保存分类</button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>