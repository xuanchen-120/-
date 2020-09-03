<?php $__env->startSection('content'); ?>
<section class="padding_btm" >
 <nav class="nav cn_nav" data-display=""  data-show-single="true" data-active-class="active" data-animate="false" style="margin-bottom: 0">
  <span data-href="<?php echo e(route('data.index',['category'=>'chant'])); ?>"  <?php if($category=='chant'): ?> class="active" <?php endif; ?> >诵经</span>
  <span data-href="<?php echo e(route('data.index',['category'=>'write'])); ?>"  <?php if($category=='write'): ?> class="active" <?php endif; ?> >抄经</span>
</nav>
<nav class="nav cn_nav" data-display=""  data-show-single="true" data-active-class="active" data-animate="false" style="background-color:#eee">
  <span data-href="<?php echo e(route('data.index',['category'=>$category,'type'=>'day'])); ?>" <?php if($type=='day'): ?> class="active" <?php endif; ?> >每日</span>
  <span data-href="<?php echo e(route('data.index',['category'=>$category,'type'=>'month'])); ?>" <?php if($type=='month'): ?> class="active" <?php endif; ?> >月度</span>
  <span data-href="<?php echo e(route('data.index',['category'=>$category,'type'=>'year'])); ?>" <?php if($type=='year'): ?> class="active" <?php endif; ?> >年度</span>
  <span data-href="<?php echo e(route('data.index',['category'=>$category,'type'=>'all'])); ?>" <?php if($type=='all'): ?> class="active" <?php endif; ?> >总数</span>
</nav>

<form action="<?php echo e(route('data.index')); ?>" id="form" method="get" accept-charset="utf-8">
 <div class="formbox">
  <div class="formbox-label">
    <?php if(in_array($type,['year','all'])): ?>
    截止
    <?php else: ?>
    日期
    <?php endif; ?>
  </div>
  <div class="formbox-input">
    <input type="text" name="datetime" id="datetime" value="<?php echo e($datetime); ?>"  class="formbox-input-text">
    <input type="hidden" name="category" value="<?php echo e($category); ?>">
    <input type="hidden" name="type" value="<?php echo e($type); ?>">
  </div>
</div>
</form>


<!--记录-->
<?php if(in_array($type,['day','month'])): ?>
<div class="accounts_detail" style="background-color:#eee">
</div>
<?php endif; ?>
<ul class="bi-list" style="background:none">
  <div class="record_title1 record_block2">
    <span>共计</span>
    <span>参与人数</span>
    <span>平均值</span>
    <span>我的排名</span>
  </div>

  <li style="background-color: #fff;padding: .6rem 0">
    <div class="record_block1 record_block2">
      <div class="bi-list-r bi-list-small"><?php echo e($sum??'0'); ?></div>
      <div class="bi-list-l bi-list-small"><?php echo e($count??0); ?></div>
      <div class="bi-list-r bi-list-small"><?php echo e(intval($average)); ?></div>
      <div class="bi-list-r bi-list-small"><?php echo e($ranking??'0'); ?></div>
    </div>
  </li>
</ul>

<div class="accounts_detail" style="background-color:#eee">
  排行数据
</div>
<ul class="bi-list" style="background:none">
  <?php if(!$lists->isEmpty()): ?>
  <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <li style="background-color: #fff;padding: .6rem 0">
    <div class="record_block1">
      <div class="bi-list-r bi-list-small">TOP <?php echo e($loop->iteration); ?></div>
      <div class="bi-list-l bi-list-small"><?php echo e($data->info->nickname); ?></div>
      <div class="bi-list-r bi-list-small"><?php echo e($data->count); ?>部</div>
    </div>
  </li>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>

</ul>
<!--end 记录-->
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="/assets/home/js/laydate/laydate.js" type="text/javascript" ></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">

  laydate.render({
  elem: '#datetime' //指定元素
  <?php if($type=='month'): ?>
  ,type: 'month'
  ,format: 'yyyy-MM'
  <?php else: ?>
  ,type: 'date'
  ,format: 'yyyy-MM-dd'
  <?php endif; ?>

  // ,min: '<?php echo e(date('Y',time())); ?>-1-1'
  // ,max: '<?php echo e(date('Y',time())); ?>-12-31'
  ,done: function(value, date, endDate){
    $('#datetime').val(value);
    $("#form").submit();
  }
});

  // $.get('https://api.yousupin.cn/articles/news',function(res){
    // console.log(res);
  // });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>