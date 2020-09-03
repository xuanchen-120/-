<?php $__env->startSection('title', 'roles - index'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-8 m-b">
                    <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="300" href="<?php echo e(route('RuLong.roles.create')); ?>">
                        <i class="fa fa-plus"></i>
                        新增角色
                    </a>
                </div>
                <div class="col-sm-4 m-b">
                    <form action="<?php echo e(url()->current()); ?>" method="get" accept-charset="utf-8">
                        <div class="input-group">
                            <input type="text" placeholder="请输入关键词" name="keyword" class="input-sm form-control" value="<?php echo e(Request::get('keyword')); ?>" />
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-primary">搜索</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="50">序号</th>
                            <th width="150">角色名称</th>
                            <th>角色描述</th>
                            <th width="140">创建时间</th>
                            <th width="220"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="edit" data-url="<?php echo e(route('RuLong.roles.edit', $role)); ?>">
                            <td><?php echo e($role->id); ?></td>
                            <td><?php echo e($role->name); ?></td>
                            <td><?php echo e($role->description); ?></td>
                            <td><?php echo e($role->created_at); ?></td>
                            <td>
                                <a href="<?php echo e(route('RuLong.roles.edit', $role)); ?>" title="编辑角色" data-toggle="layer" data-height="300">编辑</a> |
                                <form action="<?php echo e(route('RuLong.roles.destroy', $role)); ?>" method="POST" style="display:inline">
                                    <a href="javascript:void(0);" class="ajax-post confirm">
                                        删除
                                    </a>
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                </form> |
                                <a href="<?php echo e(route('RuLong.roles.menus', $role)); ?>" title="菜单授权">菜单授权</a> |
                                <a href="<?php echo e(route('RuLong.roles.users', $role)); ?>" title="菜单授权">用户授权</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <?php echo e($roles->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>