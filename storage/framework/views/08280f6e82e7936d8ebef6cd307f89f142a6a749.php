<?php $__env->startSection('title', 'menus - index'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>菜单地图</h5>
            </div>
            <div class="ibox-content">
                <div id="tree"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="ibox">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-8 m-b">
                        <?php if(Request::get('parent_id') != 0): ?>
                        <a class="btn btn-sm btn-white" href="<?php echo e(route('RuLong.menus.index')); ?>"><i class="fa fa-angle-left"></i> 返回</a>
                        <?php endif; ?>
                        <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="400" href="<?php echo e(route('RuLong.menus.create', ['parent_id' => Request::get('parent_id')])); ?>">
                            <i class="fa fa-plus"></i>
                            新增菜单
                        </a>

                        <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="400" href="<?php echo e(route('RuLong.menus.sort', ['parent_id' => Request::get('parent_id', 0)])); ?>">
                            <i class="fa fa-sort-amount-asc"></i>
                            菜单排序
                        </a>
                    </div>
                    <div class="col-sm-4 m-b">
                        <form action="<?php echo e(url()->current()); ?>" class="form-inline pull-right" method="get" accept-charset="utf-8">
                            <div class="input-group">
                                <input type="text" placeholder="请输入关键词" name="keyword" class="input-sm form-control" value="<?php echo e(Request::get('keyword')); ?>" />
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
                                <th width="45">序号</th>
                                <th width="120">菜单名称</th>
                                <th width="45">图标</th>
                                <th width="45">排序</th>
                                <th>连接地址</th>
                                <th width="140">创建时间</th>
                                <th width="80">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><a href="<?php echo e(route('RuLong.menus.index', ['parent_id' => $menu->id])); ?>" title="<?php echo e($menu->title); ?>"><?php echo e($menu->title); ?></a></td>
                                <td><i class="fa <?php echo e($menu->icon); ?>"></i></td>
                                <td><?php echo e($menu->sort); ?></td>
                                <td><?php echo e($menu->uri); ?></td>
                                <td><?php echo e($menu->created_at); ?></td>
                                <td>
                                    <a href="<?php echo e(route('RuLong.menus.edit', $menu)); ?>" data-toggle="layer" data-height="400" class="edit" title="编辑菜单">编辑</a>
                                    <form action="<?php echo e(route('RuLong.menus.destroy', $menu)); ?>" method="POST" style="display:inline">
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
                    <?php echo e($menus->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script src="<?php echo e(admin_assets('js/plugins/treeview/bootstrap-treeview.js')); ?>"></script>
<script type="text/javascript">
    $('#tree').treeview({data: <?php echo $menuTree; ?>});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>