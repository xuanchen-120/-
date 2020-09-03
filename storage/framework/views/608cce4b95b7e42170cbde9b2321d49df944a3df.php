<?php $__env->startSection('title', 'wechat - menucreate'); ?>

<?php $__env->startSection('content'); ?>
<form method="post" action="<?php echo e(route('Admin.wechatmenus.update', $wechatmenu)); ?>" class="form-horizontal">
    <div class="form-group">
        <label class="col-xs-3 control-label">菜单名称</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="name" value="<?php echo e($wechatmenu->name); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">按钮类型</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="type" value="<?php echo e($wechatmenu->type); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">上级菜单</label>
        <div class="col-xs-8">
            <select name="parent_id" class="form-control">
                <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($parent['id']); ?>" <?php if($parent['id'] == $wechatmenu->parent_id): ?> selected  <?php endif; ?>><?php echo $parent['title_show']; ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">排序</label>
        <div class="col-xs-4">
            <input type="text" class="form-control" placeholder="" name="sort" value="<?php echo e($wechatmenu->sort); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">触发关键字</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="key" value="<?php echo e($wechatmenu->key); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">VIEW地址</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="url" value="<?php echo e($wechatmenu->url); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">发送图文MEDIA_ID</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="media_id" value="<?php echo e($wechatmenu->media_id); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">关联小程序</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="appid" value="<?php echo e($wechatmenu->appid); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">启动路径</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="pagepath" value="<?php echo e($wechatmenu->pagepath); ?>" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 col-xs-offset-3">
            <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?>
            <button class="btn btn-primary ajax-post" type="button">保存</button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>