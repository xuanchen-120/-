<?php $__env->startSection('title', 'admins - index'); ?>

<?php $__env->startSection('content'); ?>
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-4 m-b">
                <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="300" href="<?php echo e(route('RuLong.admins.create')); ?>">
                    <i class="fa fa-plus"></i>
                    新增用户
                </a>
            </div>
            <div class="col-sm-8 m-b">
                <form action="<?php echo e(url()->current()); ?>" class="form-inline pull-right" method="get" accept-charset="utf-8">
                    <div class="input-group">
                        <input type="text" placeholder="请输入用户名" name="keyword" class="input-sm form-control" value="<?php echo e(Request::get('keyword')); ?>" />
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
                        <th width="50">编号</th>
                        <th width="100">用户名</th>
                        <th width="100">昵称</th>
                        <th></th>
                        <th width="140">注册时间</th>
                        <th width="50">登录</th>
                        <th width="120">上次登录IP</th>
                        <th width="140">上次登录时间</th>
                        <th width="80"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($admin->id); ?></td>
                        <td><?php echo e($admin->username); ?></td>
                        <td><?php echo e($admin->nickname); ?></td>
                        <td></td>
                        <td><?php echo e($admin->created_at); ?></td>
                        <td><?php echo e($admin->logins_count); ?></td>
                        <td><?php echo e($admin->lastLogin->login_ip); ?></td>
                        <td><?php echo e($admin->lastLogin->created_at); ?></td>
                        <td>
                            <a data-toggle="layer" data-height="300" href="<?php echo e(route('RuLong.admins.edit', $admin)); ?>" title="编辑用户">编辑</a>
                            <form action="<?php echo e(route('RuLong.admins.destroy', $admin)); ?>" method="POST" style="display:inline">
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
            <?php echo e($admins->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>