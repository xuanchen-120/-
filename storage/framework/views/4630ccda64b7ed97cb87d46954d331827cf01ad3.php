<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<section class="padding_btm" >
    <!-- 提现表单 Start -->
    <form action="<?php echo e(route('write.reportdo')); ?>" method="POST" accept-charset="utf-8">
       <div class="formbox">
            <div class="formbox-label">
                日期
            </div>
            <div class="formbox-input">
                <input type="text" name="created_at" id="datetime" value=""  class="formbox-input-text">
            </div>
        </div>

        <div class="formbox">
            <div class="formbox-label">
                抄经数
            </div>
            <div class="formbox-input">
                <input type="number" name="number" value="" placeholder="输入抄经数" class="formbox-input-text">
            </div>
        </div>

    </div>
    <div class="button_btm">
        <?php echo csrf_field(); ?>
        <button type="button" class="btn ajax-post">提交</button>
    </div>
</form>
<!-- 提现表单 End -->
</section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="/assets/home/js/laydate/laydate.js" type="text/javascript" ></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">

    laydate.render({
      elem: '#datetime'
      ,type: 'date'
      ,value: '<?php echo e(date('Y-m-d',time())); ?>'
      ,format: 'yyyy-MM-dd'
  });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>