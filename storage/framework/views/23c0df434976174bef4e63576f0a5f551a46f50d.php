<?php $__env->startSection('content'); ?>
<section class="padding_btm" >
    <div class="beer-order-list">
        
        <div class="num_0415">
            迄今为止（使用报数系统前的功课总数）
        </div>
        <ul class="num_statistics_list">
            <li>
                <div class="statistics_list_name text-nowrap">诵经</div>
                <div class="report_proportion"><?php echo e($all['chant']->number??'0'); ?></div>
                <span>
                    <?php if(empty($all['chant'])): ?>
                    <div class="j_sm_btn1" data-href="<?php echo e(route('mydata.all',['type'=>'chant'])); ?>"><i class="icon icon-plus"></i></div>
                    <?php else: ?>
                    <div class="j_sm_btn1" data-href="<?php echo e(route('mydata.yeardo',['data'=>$all['chant']])); ?>"><i class="icon icon-pencil"></i></div>
                    <?php endif; ?>
                </span>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">抄经</div>
                <div class="report_proportion"><?php echo e($all['write']->number??'0'); ?></div>
                <span>
                    <?php if(empty($all['write'])): ?>
                    <div class="j_sm_btn1" data-href="<?php echo e(route('mydata.all',['type'=>'write'])); ?>"><i class="icon icon-plus"></i></div>
                    <?php else: ?>
                    <div class="j_sm_btn1" data-href="<?php echo e(route('mydata.yeardo',['data'=>$all['write']])); ?>"><i class="icon icon-pencil"></i></div>
                    <?php endif; ?>
                </span>
            </li>
        </ul>
        <div class="num_0415">
            发愿数 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button type="button" class="btn info has-badge " data-href="<?php echo e(route('mydata.desires')); ?>"><i class="icon icon-plus"></i> </button>
        </div>
        <ul class="num_statistics_list">
            <?php if($desires->isEmpty()): ?>
            <li>
                <div class="statistics_list_name text-nowrap">未提交数据</div>
                <div class="report_proportion"></div>
            </li>
            <?php else: ?>
            <?php $__currentLoopData = $desires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <div class="statistics_list_name text-nowrap"> <?php echo e($data->year); ?> </div>
                <div class="report_proportion"><?php echo e($data->name); ?></div>
                <div class="statistics_list_num text-nowrap"><span> <?php echo e($data->number); ?> </span><i class="icon icon-pencil" data-href="<?php echo e(route('mydata.desiresdo',$data)); ?>" ></i></div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

        </ul>
    </div>
</div>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>