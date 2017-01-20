<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">

        <title>Tweelz</title>

        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/font-awesome.min.css')); ?>">

        <?php echo $__env->yieldContent('styles'); ?>
    </head>
    <body>
       <?php $__env->startSection('header'); ?>
           <?php echo $__env->make('partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
       <?php echo $__env->yieldSection(); ?>

    <?php echo $__env->yieldContent('content'); ?>

        <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/app.js')); ?>"></script>

        <?php echo $__env->yieldContent('scripts'); ?>

       <?php $__env->startSection('footer'); ?>
           <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
       <?php echo $__env->yieldSection(); ?>

    </body>
</html>



