<?php $__env->startSection('title', 'menus - sort'); ?>

<?php $__env->startSection('content'); ?>
<div class="dd">
    <ol class="dd-list">
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="dd-item" data-id="<?php echo e($menu->id); ?>">
            <div class="dd-handle">
                <span class="label label-info"><i class="fa <?php echo e($menu->icon); ?>"></i></span>
                <?php echo e($menu->title); ?>

            </div>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>
    <button class="btn btn-primary" disabled id="doAction" type="button">保存排序</button>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script src="<?php echo e(admin_assets('js/plugins/nestable/jquery.nestable.js')); ?>"></script>
<script type="text/javascript">
    var sort = '';
    $('.dd').nestable({
        maxDepth:1
    }).on('change', function(e) {
        sort = JSON.stringify($('.dd').nestable('serialize'));
        $('#doAction').removeAttr('disabled');
    });

    $('#doAction').on('click', function() {
        $.post('<?php echo e(url()->current()); ?>', {sort, _token: '<?php echo e(csrf_token()); ?>'}, function(data) {
            var prt = parent;
            if (data.code) {
                var index = prt.layer.getFrameIndex(window.name);
                prt.layer.close(index);
                prt.updateAlert(data.msg, data.code, function() {
                    prt.location.reload();
                });
            } else {
                prt.updateAlert(data.msg, data.code);
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>