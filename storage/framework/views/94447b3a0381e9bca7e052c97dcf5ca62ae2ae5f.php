<?php $__env->startSection('title', 'articles - index'); ?>



<?php $__env->startSection('content'); ?>
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-12 m-b">
                <form action="<?php echo e(url()->current()); ?>" class="form-inline pull-right" method="get" accept-charset="utf-8">
                    <div class="input-group">
                        <div class="form-group">
                            <input type="text" style="width:250px;" placeholder="请输入法名" name="nickname" class="input-sm form-control" value="<?php echo e(Request::get('nickname')); ?>">
                        </div>
                        <div class="form-group" id="time-interval">
                            <div class="input-daterange input-group">
                                <input type="text" class="input-sm form-control" placeholder="开始时间" readonly name="start" value="<?php echo e(Request::get('start')); ?>" />
                                <span class="input-group-addon">到</span>
                                <input type="text" class="input-sm form-control" placeholder="结束时间" readonly name="end" value="<?php echo e(Request::get('end')); ?>" />
                            </div>
                        </div>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <h4 class="example-title">总数：<?php echo e($allsum); ?></h4>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">序号</th>
                        <th width="50">法名</th>
                        <th width="50">手机号</th>
                        <th width="50">诵经数</th>
                        <th width="140">提交时间</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $chants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($chant->id); ?></td>
                        <td><?php echo e($chant->user->info->nickname); ?></td>
                        <td><?php echo e($chant->user->username); ?></td>
                        <td><?php echo e($chant->number); ?></td>
                        <td><?php echo e($chant->created_at); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="text-right">
            <?php echo e($chants->appends(['nickname'=>Request::get('nickname')])->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script type="text/javascript" src="<?php echo e(admin_assets('js/plugins/datapicker/bootstrap-datepicker.js')); ?>"></script>
<script type="text/javascript">
    $("#time-interval .input-daterange").datepicker({
        keyboardNavigation: !1,
        forceParse: !1,
        autoclose: !0
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(admin_assets('css/plugins/datapicker/datepicker3.css')); ?>" />
<style>
    .edit {
        cursor: pointer;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>