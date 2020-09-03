<?php $__env->startSection('title', 'menus - index'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>菜单树形图</h5>
                <div class="ibox-tools">
                    <a class="btn btn-primary btn-xs ajax-get" href="<?php echo e(route('Admin.wechatmenus.sync')); ?>">同步菜单</a>
                    <a class="btn btn-primary btn-xs ajax-get" href="<?php echo e(route('Admin.wechatmenus.publish')); ?>">发布到微信</a>
                </div>
            </div>
            <div class="ibox-content">
                <div id="tree"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="ibox">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12 m-b" style="display:flex">
                        <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="560" href="<?php echo e(route('Admin.wechatmenus.create')); ?>">
                            <i class="fa fa-plus"></i> 创建菜单
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50">序号</th>
                                <th>内容标题</th>
                                <th width="100">按钮类型</th>
                                <th width="140">创建时间</th>
                                <th width="140">更新时间</th>
                                <th width="80"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($menu->id); ?></td>
                                <td><?php echo e($menu->name); ?></td>
                                <td><?php echo e($menu->type); ?></td>
                                <td><?php echo e($menu->created_at); ?></td>
                                <td><?php echo e($menu->updated_at); ?></td>
                                <td>
                                    <a data-toggle="layer" data-height="560" href="<?php echo e(route('Admin.wechatmenus.edit', $menu)); ?>">编辑</a>
                                    <form action="<?php echo e(route('Admin.wechatmenus.destroy', $menu)); ?>" method="POST" style="display:inline">
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
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script src="<?php echo e(admin_assets('js/plugins/treeview/bootstrap-treeview.js')); ?>"></script>
<script src="<?php echo e(admin_assets('js/vue.min.js')); ?>"></script>
<script type="text/javascript">
    $('#tree').treeview({data: <?php echo $menus; ?>});

    $('#tree').on('nodeSelected', function(event, data) {
        console.log(data)
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>