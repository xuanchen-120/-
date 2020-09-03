 <?php if($writes->count() > 0): ?>
 <?php $__currentLoopData = $writes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $write): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <li style="background-color: #fff">
    <div class="record_left">
        <div class="record_time text-nowrap"><?php echo e($write->created_at->format('Y-m-d')); ?></div>
        <div class="record_name text-nowrap"><?php echo e($write->number); ?>部</div>
    </div>
    <div class="j_withdraw_btn1" data-href="<?php echo e(route('write.edit',$write)); ?>">修改</div>
    <div class="j_withdraw_btn2 ajax-get confirm " data-href="<?php echo e(route('write.delete',$write)); ?>" >删除</div>

</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<div class="empty" style="padding-top: 10%;">
    <img src="/assets/home/img/c010.png">
    <p>暂无记录</p>
</div>
<?php endif; ?>
