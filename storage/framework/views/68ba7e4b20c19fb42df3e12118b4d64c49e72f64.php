<?php $__env->startSection('title', 'banners - index'); ?>

<?php $__env->startSection('content'); ?>
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-8 m-b">
                <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="420" href="<?php echo e(route('Admin.banners.create')); ?>">
                    <i class="fa fa-plus"></i>
                    新增节点
                </a>
            </div>
            <div class="col-sm-4 m-b">
                <form action="<?php echo e(url()->current()); ?>" class="form-inline pull-right" method="get" accept-charset="utf-8">
                    <div class="input-group">
                        <input type="text" placeholder="请输入节点名称" name="keyword" class="input-sm form-control" value="<?php echo e(Request::get('keyword')); ?>">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="100">调用标签</th>
                        <th width="100">节点名称</th>
                        <th>描述</th>
                        <th width="100">Banner条数</th>
                        <th width="140">创建时间</th>
                        <th width="140">更新时间</th>
                        <td width="80">操作</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="edit">
                        <td><?php echo e($banner->tag); ?></td>
                        <td><?php echo e($banner->name); ?></td>
                        <td><?php echo e($banner->description); ?></td>
                        <td><a href="<?php echo e(route('Admin.banners.show', $banner)); ?>"><?php echo e($banner->banners_count); ?></a></td>
                        <td><?php echo e($banner->created_at); ?></td>
                        <td><?php echo e($banner->updated_at); ?></td>
                        <td>
                            <a data-toggle="layer" data-height="350" href="<?php echo e(route('Admin.banners.edit', $banner)); ?>">编辑</a>
                            <form action="<?php echo e(route('Admin.banners.destroy', $banner)); ?>" method="POST" style="display:inline">
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
            <?php echo e($positions->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>