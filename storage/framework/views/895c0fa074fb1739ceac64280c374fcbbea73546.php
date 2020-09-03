<?php $__env->startSection('title', 'users - create'); ?>

<?php $__env->startPush('script'); ?>
<script type="text/javascript">
    $('body').on('change', '#province', function(event){
        var psn = $(this).find('option').not(function() {return !this.selected}).attr('data-id');
        $.post('<?php echo e(route("Admin.ajaxs.getcities")); ?>?_token=<?php echo e(csrf_token()); ?>', {psn: psn}, function(data){
            $('#city').empty();
            var str = '';
            if (data.code == 1) {
                for (var second in data.data)
                {
                    str +='<option value="' + data.data[second].shortname + '">' + data.data[second].name + '</option>';
                }
                $('#city').append(str);
            } else {
                updateAlert('获取失败');
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<form class="form-horizontal" method="post" action="<?php echo e(route('Admin.users.store')); ?>" autocomplete="off">
    <div class="form-group">
        <label class="col-xs-3 control-label">用户姓名</label>
        <div class="col-xs-8">
            <input type="text" placeholder="请填写用户姓名" name="nickname" class="form-control" autocomplete="off" value="" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">手机号码</label>
        <div class="col-xs-8">
            <input type="text" placeholder="请填写手机号码" name="username" class="form-control" autocomplete="off" value="" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">身份证号</label>
        <div class="col-xs-8">
            <input type="text" placeholder="请填写用户身份证号" name="idcard" class="form-control" autocomplete="off" value="" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">国家</label>
        <div class="col-xs-8">
            <input type="text" placeholder="请填写国家" name="country" class="form-control" autocomplete="off" value="中国" readonly="readonly" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">省份</label>
        <div class="col-xs-8">
            <select class="form-control" name="province" id="province">
                <option value="">--请选择省份--</option>
                <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($area->shortname); ?>" data-id="<?php echo e($area->sn); ?>"><?php echo e($area->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">城市</label>
        <div class="col-xs-8">
            <select class="form-control" name="city" id="city">
                <option value="">--请选择城市--</option>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-8">
            <?php echo csrf_field(); ?>
            <button class="btn btn-primary ajax-post" type="button">新增用户</button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>