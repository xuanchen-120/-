<?php $__env->startSection('title', 'actives - index'); ?>

<?php $__env->startSection('content'); ?>
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-8 m-b">
                <a class="btn btn-sm btn-primary" href="<?php echo e(route('Admin.actives.create')); ?>">
                    <i class="fa fa-plus"></i>
                    新增活动
                </a>
            </div>
            <div class="col-sm-4 m-b">
                <form action="<?php echo e(url()->current()); ?>" class="form-inline pull-right" method="get" accept-charset="utf-8">
                    <div class="input-group">
                        <input type="text" placeholder="请输入关键词" name="keyword" class="input-sm form-control" value="<?php echo e(Request::get('keyword')); ?>">
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
                        <th width="80">序号</th>
                        <th width="250">活动名称</th>
                        <th width="80">活动类型</th>
                        <th width="80">活动人数</th>
                        <th width="300">活动时间</th>
                        <th width="120">创建时间</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $actives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($active->id); ?></td>
                        <td><?php echo e($active->name); ?></td>
                        <td><?php if($active->is_fee == 1): ?> 收费活动 <?php else: ?> 免费活动 <?php endif; ?></td>
                        <td><?php echo e($active->limits ?? '无限制'); ?>/<a href="<?php echo e(route('Admin.actives.users', $active)); ?>"><?php echo e($active->users->count()); ?></a></td>
                        <td><?php echo e($active->start_date->toDateTimeString()); ?> 至 <?php echo e($active->finish_date->toDateTimeString()); ?></td>
                        <td><?php echo e($active->created_at); ?></td>
                        <td>
                            
                            <a href="<?php echo e(route('Admin.actives.edit', $active)); ?>">编辑</a>
                            <form action="<?php echo e(route('Admin.actives.destroy', $active)); ?>" method="POST" style="display:inline">
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
            <?php echo e($actives->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>