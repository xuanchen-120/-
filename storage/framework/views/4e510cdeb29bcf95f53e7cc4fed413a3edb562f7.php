<?php $__env->startSection('content'); ?>
<section class="padding_btm" >
    <div class="beer-order-list">
        <div class="num_0415">
            诵经数据
        </div>
        <ul class="num_statistics_list">
            <li>
                <div class="statistics_list_name text-nowrap">本日</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> <?php echo e($chants['today']); ?> </span></div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">本月</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> <?php echo e($chants['month']); ?> </span></div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">本年</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> <?php echo e($chants['year'] + $data['year_chant']); ?> </span></div>
                <div class="report_child">
                    <span>以往数据：<?php echo e($data['year_chant']); ?></span>
                    <span>系统数据：<?php echo e($chants['year']); ?></span>
                </div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">迄今为止</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> <?php echo e($chants['all'] + $data['all_chant']); ?> </span></div>
                <div class="report_child">
                    <span>以往数据：<?php echo e($data['all_chant']); ?></span>
                    <span>系统数据：<?php echo e($chants['all']); ?></span>
                </div>
            </li>
        </ul>
        <div class="num_0415">
            抄经数据
        </div>
        <ul class="num_statistics_list">
            <li>
                <div class="statistics_list_name text-nowrap">本日</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> <?php echo e($writes['today']); ?> </span></div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">本月</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> <?php echo e($writes['month']); ?> </span></div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">本年</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span><?php echo e($writes['year'] + $data['year_write']); ?>  </span></div>
                 <div class="report_child">
                    <span>以往数据：<?php echo e($data['year_write']); ?></span>
                    <span>系统数据：<?php echo e($writes['year']); ?></span>
                </div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">迄今为止</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> <?php echo e($writes['all'] + $data['all_write']); ?>  </span></div>
                <div class="report_child">
                    <span>以往数据：<?php echo e($data['all_write']); ?></span>
                    <span>系统数据：<?php echo e($writes['year']); ?></span>
                </div>
            </li>

        </ul>
    </div>
</div>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>