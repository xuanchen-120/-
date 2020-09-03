<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="renderer" content="webkit" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title><?php echo e(config('RuLong.title', '')); ?> 系统管理</title>
    <link rel="stylesheet" href="<?php echo e(admin_assets('css/bootstrap.min.css?v=3.3.6')); ?>" />
    <link rel="stylesheet" href="<?php echo e(admin_assets('css/font-awesome.min.css?v=4.4.0')); ?>" />
    <link rel="stylesheet" href="<?php echo e(admin_assets('css/animate.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(admin_assets('css/style.min.css?v=4.1.0')); ?>" />
    <link rel="stylesheet" href="<?php echo e(admin_assets('css/plugins/sweetalert/sweetalert.css')); ?>" />

    <script type="text/javascript" src="<?php echo e(admin_assets('js/jquery.min.js?v=2.1.4')); ?>"></script>
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <?php echo $__env->make('RuLong::common.nav', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars"></i></a>
                    </div>
                    <?php echo $__env->make('RuLong::common.msg', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </nav>
            </div>

            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i></button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                        <a href="javascript:;" class="active J_menuTab" data-id="<?php echo e(admin_url('dashboard')); ?>">看板</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i></button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作&nbsp;<span class="caret"></span></button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <li class="J_tabShowActive"><a>定位当前选项卡</a></li>
                        <li class="J_tabReloadActive"><a>重载当前选项卡</a></li>
                        <li class="divider"></li>
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a></li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a></li>
                    </ul>
                </div>
                <a href="javascript:void(0);" data-href="<?php echo e(admin_url('auth/logout')); ?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i>&nbsp;退出</a>
            </div>

            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php echo e(admin_url('dashboard')); ?>" frameborder="0" data-id="<?php echo e(admin_url('dashboard')); ?>" seamless></iframe>
            </div>

            <div class="footer">
                <div class="pull-right">
                    &copy; 2010-<?php echo e(date('Y')); ?>

                </div>
            </div>
        </div>
        <!--右侧部分结束-->
    </div>

    <script type="text/javascript" src="<?php echo e(admin_assets('js/bootstrap.min.js?v=3.3.6')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(admin_assets('js/plugins/metisMenu/jquery.metisMenu.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(admin_assets('js/plugins/slimscroll/jquery.slimscroll.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(admin_assets('js/plugins/layer/layer.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(admin_assets('js/hplus.min.js?v=4.1.0')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(admin_assets('js/plugins/sweetalert/sweetalert.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(admin_assets('js/contabs.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(admin_assets('js/common.js')); ?>"></script>
</body>

</html>
