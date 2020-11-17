<?php $__env->startSection('title', __('admin.provides.Provider_Details')); ?>

<?php $__env->startSection('content'); ?>


    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
            <h4 class="card-title"><?php echo app('translator')->getFromJson('admin.provides.Provider_Details'); ?></h4>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="box bg-white user-1">
                        <?php $background = asset('admin/assets/img/photos-1/4.jpg'); ?>
                        <div class="u-img img-cover" style="background-image: url(<?php echo e($background); ?>);"></div>
                        <div class="u-content">
                            <div class="avatar box-64">
                                <img class="b-a-radius-circle shadow-white" src="<?php echo e(img($provider->picture)); ?>" alt="">
                                <i class="status bg-success bottom right"></i>
                            </div>
                            <p class="text-muted">
                                <?php if($provider->is_approved == 1): ?>
                                <span class="tag tag-success"><?php echo app('translator')->getFromJson('admin.provides.Approved'); ?></span>
                                <?php else: ?>
                                <span class="tag tag-success"><?php echo app('translator')->getFromJson('admin.provides.Not_Approved'); ?></span>
                                <?php endif; ?>
                            </p>
                            <h5><a class="text-black" href="#"><?php echo e($provider->first_name); ?> <?php echo e($provider->last_name); ?></a></h5>
                            <p class="text-muted"><?php echo app('translator')->getFromJson('admin.email'); ?> : <?php echo e($provider->email); ?></p>
                            <p class="text-muted"><?php echo app('translator')->getFromJson('admin.mobile'); ?> : <?php echo e($provider->mobile); ?></p>
                            <p class="text-muted"><?php echo app('translator')->getFromJson('admin.gender'); ?> : <?php echo e($provider->gender); ?></p>
                            <p class="text-muted"><?php echo app('translator')->getFromJson('admin.address'); ?> : <?php echo e($provider->address); ?></p>
                            <p class="text-muted">
                                <?php if($provider->is_activated == 1): ?>
                                <span class="tag tag-warning">"><?php echo app('translator')->getFromJson('admin.provides.Activated'); ?></span>
                                <?php else: ?>
                                <span class="tag tag-warning">"><?php echo app('translator')->getFromJson('admin.provides.Not_Activated'); ?></span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>