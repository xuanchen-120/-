<?php $__env->startSection('title', 'roles - users'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-7">
        <div class="ibox">
            <div class="ibox-title">
                <h5><a href="<?php echo e(route('RuLong.roles.index' )); ?>"><i class="fa fa-angle-left"></i> 授权管理</a> 已授权用户</h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>UID</th>
                                <th>用户名</th>
                                <th>昵称</th>
                                <th>授权时间</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($admin->id); ?></td>
                                <td><?php echo e($admin->username); ?></td>
                                <td><?php echo e($admin->nickname); ?></td>
                                <td><?php echo e($admin->pivot->created_at); ?></td>
                                <td>
                                    <a class="ajax-get confirm" href="<?php echo e(route('RuLong.roles.remove', ['role' => $role, 'admin' => $admin])); ?>" title="">移除</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <?php echo e($admins->links()); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="ibox">
            <div class="ibox-title">
                <h5>搜索用户</h5>
            </div>
            <div class="ibox-content">
                <div class="m-b">
                    <form action="<?php echo e(url()->current()); ?>" method="post" accept-charset="utf-8" onkeydown="if (event.keyCode==13) return false;">
                        <div class="input-group">
                            <input type="text" placeholder="请输入UID/用户名" name="username" class="input-sm form-control" value="">
                            <span class="input-group-btn">
                                <?php echo csrf_field(); ?>
                                <button type="button" class="btn btn-sm btn-primary" id="search">搜索</button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>UID</th>
                                <th>用户名</th>
                                <th>昵称</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="toAuthed">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script type="text/javascript">
    $('#search').on('click', function() {
        var $this = $(this);
        var $form = $this.parents('form');
        var query = $form.serialize();
        $.post('<?php echo e(url()->current()); ?>', query, function(data) {
            $('#toAuthed').empty();
            for (var i = 0; i < data.length; i++) {
                var url = '<?php echo e(route("RuLong.roles.auth", ["role" => $role, "admin" => "****"])); ?>';
                $('#toAuthed').append('<tr><td>' + data[i].id + '</td><td>' + data[i].username + '</td><td>' + data[i].nickname + '</td><td><a class="ajax-get confirm" href="' + url.replace('****', data[i].id) + '" title="">授权</a></td></tr>')
            };
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('RuLong::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>