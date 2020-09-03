<?php $__env->startSection('title', 'articles - edit'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <form method="post" action="<?php echo e(route('Admin.articles.update', $article)); ?>" class="form-horizontal">
        <div class="col-sm-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑文章内容</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">内容标题</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" value="<?php echo e($article->title); ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">文章正文</label>
                        <div class="col-sm-10">
                            <?php echo $__env->make('Admin::common.ueditor', ['content' => $article->content], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('put'); ?>
                            <button class="btn btn-primary ajax-post" type="submit">保存内容</button>
                            <a class="btn btn-white" href="javascript:history.go(-1)" title="返回">返回</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>附加属性</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">分类</label>
                        <div class="col-xs-8">
                            <select class="form-control" name="category_id">
                                <?php $__currentLoopData = $category_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value['id']); ?>" <?php if($value['id'] == $article->category_id): ?> selected <?php endif; ?> ><?php echo $value['title_show']; ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">内容简介</label>
                        <div class="col-sm-9">
                            <textarea name="description" rows="4" class="form-control"><?php echo e($article->description); ?></textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">封面图片</label>
                        <div class="col-sm-9">
                            <?php echo $__env->make('Admin::common.webuploader', ['storage' => $article->storage], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>