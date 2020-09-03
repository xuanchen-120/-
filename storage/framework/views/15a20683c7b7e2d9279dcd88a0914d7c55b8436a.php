<?php $__env->startSection('content'); ?>
<section class="padding_btm" id="app" >
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="accounts_detail" style="background-color:#eee">
        抄经数据
    </div>
    <ul class="bi-list" style="background:none">
        <div class="record_title">
            <span>本日</span>
            <span>本月</span>
            <span>本年</span>
            <span>迄今为止</span>
        </div>

        <li style="background-color: #fff;padding: .6rem 0">
            <div class="record_block">
                <div class="bi-list-r bi-list-small"><?php echo e($write_data['today']); ?></div>
                <div class="bi-list-l bi-list-small"><?php echo e($write_data['month']); ?></div><!--提现金额-->
                <div class="bi-list-r bi-list-small"><?php echo e($write_data['year']); ?></div><!--实到金额-->
                <div class="bi-list-r bi-list-small"><?php echo e($write_data['all'] + $data['all_write']); ?></div><!--提现方式-->
            </div>
        </li>
    </ul>
    <div class="beer-order-list">
       
        <div class="num_0415">
            发愿数
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
                <div class="statistics_list_num text-nowrap"><span> <?php echo e($data->number); ?> </span></div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

        </ul>
    </div>
    <!-- 收支记录 Start -->
    <div class="accounts_detail">
        <div class="j_withdraw_btn1" data-href="<?php echo e(route('write.report')); ?>">报数</div>
        抄经明细
    </div>
    <ul class="bi-list" style="background:none" id="list">
        <?php if($writes->count() > 0): ?>
        <?php echo $__env->make('write.list', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php else: ?>
        <div class="empty">
            <img src="/assets/home/img/c010.png">
            <p>暂无提现记录</p>
        </div>
        <?php endif; ?>
    </ul>
    <!-- 收支记录 End -->
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript" src="/assets/home/js/PullToRefresh.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">

    <?php if($writes->count()>14): ?>
    /*上拉加载更多*/
    var n=2,flag=true;
    var refreshBox=new PullToRefresh({
        container:"#app",
        up:{
            callback:function(){
                $.get("<?php echo e(route('chant.more')); ?>",{page:n},function(res){
                    if(res.statusCode==200){
                        $("#list").append(res.message);
                        refreshBox.endUpLoading(true)
                        n++
                    }else{
                        refreshBox.endUpLoading(false)

                    }
                });
            }
        }
    })
    <?php endif; ?>


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>