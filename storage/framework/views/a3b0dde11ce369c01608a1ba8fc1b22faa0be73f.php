<?php $__env->startSection('title', 'users - index'); ?>

<?php $__env->startSection('content'); ?>
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-8 m-b">
                <form action="<?php echo e(url()->current()); ?>" class="form-inline pull-right" method="get" accept-charset="utf-8">
                    <div class="input-group">
                        <input type="text" placeholder="请输入手机号" name="mobile" class="input-sm form-control" value="<?php echo e(Request::get('mobile')); ?>" />
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="请输入用户昵称" name="nickname" class="input-sm form-control" value="<?php echo e(Request::get('nickname')); ?>" />
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
                        <th width="45">编号</th>
                        <th width="250">手机号</th>
                        <th width="250">法名</th>
                        <th width="250">发愿数</th>
                        <th width="250">诵经总数</th>
                        <th width="250">抄经总数</th>
                        <th width="140">创建时间</th>
                        <th width="80"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="padding:0"><?php echo e($user->id); ?></td>
                        <td><?php echo e($user->username); ?></td>
                        <td><?php echo e($user->info->nickname ?? ''); ?></td>
                        <td>
                            <?php $__currentLoopData = $user->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($data['channel']=='desires'): ?>
                                <?php echo e($data->dated_at->format('Y-m-d')); ?> <?php echo e($data->channel_name); ?><?php echo e($data->name); ?>:<?php echo e($data->number); ?><br>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </td>
                        <td><?php echo e($user->chant()->sum('number')); ?> </td>
                        <td><?php echo e($user->write()->sum('number')); ?> </td>
                        <td><?php echo e($user->created_at); ?></td>
                        <td>
                            <a title="编辑用户" data-toggle="layer" target="dialog" data-height="500"  data-width="500"   href="<?php echo e(route('Admin.users.edit', $user)); ?>" rel="dialog<?php echo e(time()); ?>" class="btnEdit">编辑</a>
                            <form action="<?php echo e(route('Admin.users.destroy', $user)); ?>" method="POST" style="display:inline">
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
            <?php echo e($users->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>