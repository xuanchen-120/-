<?php $__env->startSection('title', 'actives - users'); ?>

<?php $__env->startSection('content'); ?>
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-8 m-b">
                <a class="btn btn-sm btn-primary" href="<?php echo e(route('Admin.actives.index')); ?>">
                    <i class="fa fa-level-up"></i>
                    返回
                </a>
            </div>
            <div class="col-sm-4 m-b">
                <form action="<?php echo e(url()->current()); ?>" class="form-inline pull-right" method="get" accept-charset="utf-8">
                    <div class="input-group">
                        <input type="text" placeholder="请输入用户姓名" name="keyword" class="input-sm form-control" value="<?php echo e(Request::get('keyword')); ?>">
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
                        <th width="250">所属用户姓名</th>
                        <th width="250">报名人姓名</th>
                        <th width="150">报名人联系方式</th>
                        <th width="250">报名人行业</th>
                        <th width="120">报名时间</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($user->id); ?></td>
                        <td><?php echo e($user->user->info->nickname); ?></td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->contact); ?></td>
                        <td><?php echo e($user->category->name); ?></td>
                        <td><?php echo e($user->created_at->toDateTimeString()); ?></td>
                        <td>
                            <?php if($active->start_date->timestamp < time() && $active->finish_date->timestamp > time()): ?>
                            <?php if($user->signed == 1): ?>
                            已签到
                            <?php else: ?>
                            <a class="ajax-get" href="<?php echo e(route('Admin.actives.userSign', $user)); ?>">签到</a>
                            <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="text-right">
            <?php echo e($users->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>