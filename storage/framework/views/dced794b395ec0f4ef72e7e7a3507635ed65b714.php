<?php $__env->startSection('title', 'logs - index'); ?>

<?php $__env->startSection('content'); ?>
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <form action="<?php echo e(url()->current()); ?>" class="form-inline pull-right" method="get" accept-charset="utf-8">
                <div class="input-group">
                    <input type="text" placeholder="请输入用户名" name="keyword" class="input-sm form-control" value="<?php echo e(Request::get('keyword')); ?>" />
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                    </span>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">序号</th>
                        <th width="100">用户</th>
                        <th width="100">Path</th>
                        <th width="60">Method</th>
                        <th width="100">IP</th>
                        <th>Input</th>
                        <th width="140">创建时间</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($log->admin->username); ?></td>
                        <td><?php echo e($log->path); ?></td>
                        <td><?php echo $log->method; ?></td>
                        <td><?php echo e($log->ip); ?></td>
                        <td><?php echo e($log->input); ?></td>
                        <td><?php echo e($log->created_at); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="text-right">
            <?php echo e($logs->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>