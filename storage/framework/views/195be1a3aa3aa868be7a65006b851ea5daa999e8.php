<?php $__env->startSection('title', 'categories - index'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>分类地图</h5>
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
                    <div class="col-sm-6 m-b">
                        <?php if(Request::get('parent_id') != 0): ?>
                        <a class="btn btn-sm btn-white" href="<?php echo e(route('Admin.categories.index')); ?>"><i class="fa fa-angle-left"></i> 返回</a>
                        <?php endif; ?>
                        <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="420" href="<?php echo e(route('Admin.categories.create')); ?>">
                            <i class="fa fa-plus"></i>
                            新增分类
                        </a>
                    </div>
                    <div class="col-sm-6 m-b">
                        <form action="<?php echo e(url()->current()); ?>" class="form-inline pull-right" method="get" accept-charset="utf-8">
                            <select class="input-sm form-control" style="width:150px;margin-right: 2px" name="type">
                                <option value="">分类模型</option>
                                <?php $__currentLoopData = config('catetype'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php if($key == Request::get('type')): ?> selected <?php endif; ?> ><?php echo e($model); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
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
                                <th width="50">序号</th>
                                <th width="150">分类名称</th>
                                <th width="100">分类类别</th>
                                <th></th>
                                <th width="50">排序</th>
                                <th width="140">创建时间</th>
                                <th width="140">更新时间</th>
                                <th width="80"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><a href="<?php echo e(route('Admin.categories.index', ['parent_id' => $category->id])); ?>"><?php echo e($category->name); ?></a></td>
                                <td><?php echo e($category->type_text); ?></td>
                                <td></td>
                                <td><?php echo e($category->sort); ?></td>
                                <td><?php echo e($category->created_at); ?></td>
                                <td><?php echo e($category->updated_at); ?></td>
                                <td>
                                    <a data-toggle="layer" data-height="420" href="<?php echo e(route('Admin.categories.edit', $category)); ?>">编辑</a>
                                    <form action="<?php echo e(route('Admin.categories.destroy', $category)); ?>" method="POST" style="display:inline">
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
                <?php echo e($categories->appends(['parent_id' => Request::get('parent_id'), 'type' => Request::get('type'), 'keyword' => Request::get('keyword')])->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script src="<?php echo e(admin_assets('js/plugins/treeview/bootstrap-treeview.js')); ?>"></script>
<script type="text/javascript">
    $('#tree').treeview({data: <?php echo $categoriesJson; ?>});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>