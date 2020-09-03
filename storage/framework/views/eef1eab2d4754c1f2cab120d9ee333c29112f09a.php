<?php $__env->startSection('title', 'menus - edit'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(admin_assets('css/plugins/iCheck/custom.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script src="<?php echo e(admin_assets('js/plugins/iCheck/icheck.min.js')); ?>"></script>
<script>
    $(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green"});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<form method="post" action="<?php echo e(route('RuLong.menus.update', $menu)); ?>" class="form-horizontal">
    <div class="form-group">
        <label class="col-xs-3 control-label">菜单名称</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="title" value="<?php echo e($menu->title); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">菜单图标</label>
        <div class="col-xs-4">
            <input type="text" class="form-control" placeholder="" name="icon" value="<?php echo e($menu->icon); ?>" />
        </div>
        <div class="col-xs-4">
            <i class="fa <?php echo e($menu->icon); ?>"></i>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">上级菜单</label>
        <div class="col-xs-8">
            <select class="form-control" name="parent_id">
                <?php $__currentLoopData = $topMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if($top['id'] ==  $menu->parent_id): ?> selected <?php endif; ?> value="<?php echo e($top['id']); ?>"><?php echo $top['title_show']; ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">菜单排序</label>
        <div class="col-xs-4">
            <input type="text" class="form-control" placeholder="" name="sort" value="<?php echo e($menu->sort); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">连接地址</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="uri" value="<?php echo e($menu->uri); ?>" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 col-xs-offset-3">
            <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?>
            <button class="btn btn-primary ajax-post" type="button">保存菜单</button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>