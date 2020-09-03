<?php $__env->startSection('title', 'users - upgrade'); ?>

<?php $__env->startPush('script'); ?>
<script src="<?php echo e(admin_assets('js/plugins/suggest/bootstrap-suggest.min.js')); ?>"></script>
<script type="text/javascript">
    var testBsSuggest = $("#test").bsSuggest({
        url: "<?php echo e(route('Admin.ajaxs.usernos')); ?>/",
        idField: "id",
        keyField: "no",
        getDataMethod: 'url',
        allowNoKeyword: false,
        effectiveFields: ['no']
    }).on("onSetSelectValue", function(e, keyword) {
        $('input[name="no_id"]').val(keyword.id);
    }).on("onUnsetSelectValue", function(e) {
        $('input[name="no_id"]').val('');
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<form class="form-horizontal" method="post" action="<?php echo e(url()->current()); ?>" autocomplete="off">
    <div class="form-group">
        <label class="col-xs-3 control-label">手机号</label>
        <div class="col-xs-8">
            <input type="text" readonly class="form-control" autocomplete="off" value="<?php echo e($user->username); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">姓名</label>
        <div class="col-xs-8">
            <input type="text" readonly class="form-control" autocomplete="off" value="<?php echo e($user->info->nickname); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">选择编号</label>
        <div class="col-xs-8">
            <div class="input-group">
                <input type="hidden" name="no_id" value="" />
                <input type="text" class="form-control input-sm" id="test" value="" />
                <div class="input-group-btn">
                    <button type="button" class="btn btn-white btn-sm dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-8">
            <?php echo csrf_field(); ?>
            <button class="btn btn-primary ajax-post" type="button">升级为普通会员</button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>