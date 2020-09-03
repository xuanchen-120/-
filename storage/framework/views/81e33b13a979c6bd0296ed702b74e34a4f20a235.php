<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <meta name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">
    <title><?php echo $__env->yieldContent('title', config('app.name')); ?> </title>
    <link rel="stylesheet" href="/assets/home/css/mzui.min.css">
    <link rel="stylesheet" href="/assets/home/css/style.css?<?php echo e(time()); ?>">
    <?php echo $__env->yieldContent('css'); ?>
    <?php echo $__env->yieldContent('js'); ?>

</head>
<body>
    <?php echo $__env->yieldContent('content'); ?>
    <?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldSection(); ?>
</body>

<script type="text/javascript" src="/assets/home/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/assets/home/js/mzui.min.js" ></script>
<?php $__env->startSection('layer'); ?>
<script type="text/javascript" src="/assets/home/js/layer/layer.min.js" ></script>
<?php echo $__env->yieldSection(); ?>
<script type="text/javascript" src="/assets/home/js/cjango.js?v=<?php echo e(uniqid()); ?>"></script>
<script type="text/javascript" src="/assets/home/js/vue.js"></script>
<script type="text/javascript" src="/assets/home/js/main.js"></script>
<?php echo $__env->yieldContent('script'); ?>
