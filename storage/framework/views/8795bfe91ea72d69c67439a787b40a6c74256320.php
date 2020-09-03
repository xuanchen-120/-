<?php $__env->startSection('title', 'articles - index'); ?>

<?php $__env->startSection('content'); ?>
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-4 m-b">
                <a class="btn btn-sm btn-primary" href="<?php echo e(route('Admin.articles.create')); ?>">
                    <i class="fa fa-plus"></i>
                    新增内容
                </a>
            </div>
            <div class="col-sm-8 m-b">
                <form action="<?php echo e(url()->current()); ?>" class="form-inline pull-right" method="get" accept-charset="utf-8">
                    <div class="input-group">
                        <input type="text" style="width:250px;" placeholder="请输入内容标题" name="title" class="input-sm form-control" value="<?php echo e(Request::get('title')); ?>">
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
                        <th>内容标题</th>
                        <th width="50">点击</th>
                        <th width="140">创建时间</th>
                        <th width="140">更新时间</th>
                        <th width="80"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($article->id); ?></td>
                        <td><?php echo e($article->title); ?></td>
                        <td><?php echo e($article->click); ?></td>
                        <td><?php echo e($article->created_at); ?></td>
                        <td><?php echo e($article->updated_at); ?></td>
                        <td>
                            <a href="<?php echo e(route('Admin.articles.edit', $article)); ?>">编辑</a>
                            <form action="<?php echo e(route('Admin.articles.destroy', $article)); ?>" method="POST" style="display:inline">
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
            <?php echo e($articles->appends(['keyword'=>Request::get('keyword')])->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>