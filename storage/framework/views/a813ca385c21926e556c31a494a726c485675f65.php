<?php $__env->startSection('title', '感应文章'); ?>

<?php $__env->startSection('css'); ?>
<style type="text/css" media="screen">
body {
    background: #fff;
}
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="content">
    <?php if($articles->toArray()): ?>
    <ul class="usersList">
        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li data-href="<?php echo e(route('articles.show', $article)); ?>">
            <div class="usersListImg chancesListImg usersMember">
                <img src="<?php echo e($article->storage->path ?? ''); ?>"/>
            </div>
            <div class="usersListText projectListText">
                <div class="ce-nowrap usersListText-name">
                    <?php echo e($article->title); ?>

                </div>
                <div class="chancesText">
                    <p>
                        <i class="icon icon-eye-open"></i>
                        <span><?php echo e($article->click); ?></span>
                    </p>
                    <p>
                        <i class="icon icon-time"></i>
                        <span><?php echo e($article->created_at->toDateString()); ?></span>
                    </p>
                </div>
            </div>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <?php else: ?>
    <div>
        <div class="mychancesTips">
            <img src="<?php echo e(asset('assets/home/img/Tips.jpg')); ?>">
        </div>
        <div class="mychancesCont">
            <span>还没有文章哟！</span>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>