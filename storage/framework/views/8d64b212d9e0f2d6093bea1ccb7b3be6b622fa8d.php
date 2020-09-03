<?php $__env->startSection('title', 'banners - show'); ?>

<?php $__env->startSection('content'); ?>
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-8 m-b">
                <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="420" href="<?php echo e(route('Admin.banners.nodeCreate', $position)); ?>">
                    <i class="fa fa-plus"></i>
                    新增轮播
                </a>
            </div>
            <div class="col-sm-4 m-b">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="200">MorphTo</th>
                        <th width="100">类型</th>
                        <th>显示名称</th>
                        <th width="140">创建时间</th>
                        <th width="140">更新时间</th>
                        <th width="80">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="edit">
                        <td><?php echo e($banner->showable_type); ?>::<?php echo e($banner->showable_id); ?></td>
                        <td><?php echo e($banner->type); ?></td>
                        <td><?php echo e($banner->showable->name ?? $banner->showable->title); ?></td>
                        <td><?php echo e($banner->created_at); ?></td>
                        <td><?php echo e($banner->updated_at); ?></td>
                        <td>
                            <form action="<?php echo e(route('Admin.banners.nodeDelete', $banner)); ?>" method="POST" style="display:inline">
                                <a href="javascript:void(0);" class="ajax-post confirm">
                                    删除
                                </a>
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="text-right">
            <?php echo e($banners->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>