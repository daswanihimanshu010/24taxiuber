<?php $__env->startSection('content'); ?>
<div class="row gray-section no-margin">
    <div class="container">
        <div class="content-block">
            <h2><?php echo e($title); ?></h2>
            <div class="title-divider"></div>
            <p><?php echo Setting::get($page); ?></p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>