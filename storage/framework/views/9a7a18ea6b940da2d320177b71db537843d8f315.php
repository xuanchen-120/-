<!--左侧导航开始-->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close">
        <i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span><img alt="avatar" class="img-circle" src="<?php echo e(admin_assets('img/avatar.jpg')); ?>" width="70" /></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">
                        <span class="clear">
                            <span class="block m-t-xs"><strong class="font-bold"><?php echo e(Admin::user()->nickname); ?></strong></span>
                            <span class="text-muted text-xs block"><?php echo e(Admin::user()->username); ?> <b class="caret"></b> </span>
                        </span>
                    </a>
                    <ul class="dropdown-menu m-t-xs">
                        <li><a href="<?php echo e(admin_url('password')); ?>" id="password">修改密码</a></li>
                    </ul>
                </div>
                <div class="logo-element">Cs</div>
            </li>
            <?php $__currentLoopData = $adminMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a class="J_menuItem" href="">
                    <i class="fa <?php echo e($menu['icon']); ?>"></i>
                    <span class="nav-label"><?php echo e($menu['title']); ?></span>
                </a>
                <?php if(isset($menu['children'])): ?>
                <ul class="nav nav-second-level">
                    <?php $__currentLoopData = $menu['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a class="J_menuItem" href="<?php echo e(route($children['uri'])); ?>"><i class="fa <?php echo e($children['icon']); ?>"></i> <?php echo e($children['title']); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <?php endif; ?>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</nav>
<!--左侧导航结束-->
