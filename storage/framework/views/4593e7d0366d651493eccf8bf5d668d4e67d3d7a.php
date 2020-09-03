<?php $__env->startSection('title', '个人设置'); ?>


<?php $__env->startSection('content'); ?>
<div class="content">
    <ul class="install">
        <li class="installFile">
            <span>头像</span>
            <input type="file" id="file" accept="image/*">
            <div class="installIcon" id="show">
                <img src="<?php echo e($user->info->head_img); ?>">
            </div>
            <i class="icon icon-angle-right"></i>
        </li>
        <li>
            <span>共修报数名</span>
            <div class="installIcon" data-href="<?php echo e(route('setting.info', ['user' => $user, 'field' => 'nickname'])); ?>">
                <span><?php echo e($user->info->nickname ?? ''); ?></span>
            </div>
            <i class="icon icon-angle-right"></i>
        </li>
        <li>
            <span>手机号</span>
            <div class="installIcon" style="width: calc(100% - 3.5rem)">
                <span class="immutable"><?php echo e($user->username ?? ''); ?></span>
            </div>
        </li>

        <li>
            <span>修改密码</span>
            <div class="installIcon" data-href="<?php echo e(route('settings.password')); ?>">
            </div>
            <i class="icon icon-angle-right"></i>
        </li>
    </ul>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="/assets/home/js/lrz.all.bundle.js"></script>
<script type="text/javascript">
    $('#show').click(function(event){
        $('#file').click();
    });
    $('#file').change(function(event){
        var $this = $(this);
        lrz(this.files[0], {
            width: 640,
            fieldName: 'image'
        }).then(function(rst) {
            $('#show img').attr('src', rst.base64);
            return rst;
        }).then(function(rst) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', "<?php echo e(route('storages.picture')); ?>?_token=<?php echo e(csrf_token()); ?>", true);
            xhr.onload = function () {
                var data = $.parseJSON(xhr.responseText);
                if (data.code == 1) {
                    $.post("<?php echo e(route('setting.avatar', $user)); ?>?_token=<?php echo e(csrf_token()); ?>", { avatar:data.path }, function(json){
                        if(json.status == 'SUCCESS'){
                            updateAlert(json.message);
                        } else {
                            updateAlert(json.message);
                        }
                    });
                } else {
                    updateAlert(data.message);
                }
            };
            xhr.onerror = function () {
            };
            xhr.send(rst.formData);
            return rst;
        }).catch(function (err) {
            updateAlert(err);
        }).always(function () {
            // 不管是成功失败，这里都会执行
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>