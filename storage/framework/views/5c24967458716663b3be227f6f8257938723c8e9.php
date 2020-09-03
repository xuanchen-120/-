<?php $__env->startSection('title', 'roles - menus'); ?>

<?php $__env->startSection('content'); ?>
<div class="ibox">
    <form action="<?php echo e(url()->current()); ?>" method="post" accept-charset="utf-8">
        <div class="ibox-content">
            <div class="m-b-sm">
                <a class="btn btn-white" href="<?php echo e(route('RuLong.roles.index' )); ?>"><i class="fa fa-angle-left"></i> 返回</a>
                <?php echo csrf_field(); ?>
                <button class="btn btn-primary ajax-post" type="button">保存授权</button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="main_<?php echo e($menu->id); ?>">
                            <td width="200" rowspan="<?php echo e($menu->children->count() ?: 1); ?>">
                                <input name="rules[]" class="i-checks" type="checkbox" value="<?php echo e($menu->id); ?>" data-id="<?php echo e($menu->id); ?>" <?php if(in_array($menu->id, $role->rules ?? [])): ?> checked <?php endif; ?> /><?php echo e($menu->title); ?>

                            </td>
                            <?php if($menu->children()->count() == 0): ?>
                            <td></td>
                            <td></td>
                            <?php endif; ?>

                            <?php $__currentLoopData = $menu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row => $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($row > 0): ?>
                            <tr class="main_<?php echo e($menu->id); ?>">
                                <?php endif; ?>
                                <td width="200">
                                    <input name="rules[]" class="i-checks" type="checkbox" value="<?php echo e($children->id); ?>" data-id="<?php echo e($children->id); ?>" <?php if(in_array($menu->id, $role->rules ?? [])): ?> checked <?php endif; ?> /> <?php echo e($children->title); ?>

                                </td>
                                <td class="left two_<?php echo e($children->id); ?>">
                                    <?php $__currentLoopData = $children->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $son): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input name="rules[]" class="i-checks" type="checkbox" value="<?php echo e($son->id); ?>" <?php if(in_array($son->id, $role->rules ?? [])): ?> checked <?php endif; ?> /> <?php echo e($son->title); ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </tr>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<link rel="stylesheet" href="<?php echo e(admin_assets('css/plugins/iCheck/custom.css')); ?>" />
<script src="<?php echo e(admin_assets('js/plugins/iCheck/icheck.min.js')); ?>"></script>
<script type="text/javascript">
    $(".i-checks").iCheck({
        checkboxClass: "icheckbox_square-green"
    });

    $('input[type="checkbox"]').on('ifChecked', function() {
        var $this = $(this);
        var id    = $this.attr('data-id');
        $(".main_" + id).find('input').iCheck('check')
        $(".two_" + id).find('input').iCheck('check')
    });

    $('input[type="checkbox"]').on('ifUnchecked', function() {
        var $this = $(this);
        var id    = $this.attr('data-id');
        $(".main_" + id).find('input').iCheck('uncheck')
        $(".two_" + id).find('input').iCheck('uncheck')
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>