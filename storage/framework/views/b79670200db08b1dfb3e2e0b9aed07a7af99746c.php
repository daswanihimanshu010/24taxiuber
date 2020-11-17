<?php $__env->startSection('title', 'Add Account Manager '); ?>

<?php $__env->startSection('content'); ?>

<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
              <h5 class="card-title pull-left"><?php echo app('translator')->getFromJson('admin.account-manager.add_account_manager'); ?></h5>
                <a href="<?php echo e(URL::previous()); ?>" class="btn pull-right"><i
                    class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="<?php echo e(route('admin.account-manager.store')); ?>" method="POST" enctype="multipart/form-data" role="form">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label for="name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.account-manager.full_name'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e(old('name')); ?>" name="name" required id="name" placehold="<?php echo app('translator')->getFromJson('admin.account-manager.full_name'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.email'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="email" required name="email" value="<?php echo e(old('email')); ?>" id="email" placehold="<?php echo app('translator')->getFromJson('admin.email'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.password'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="password" name="password" id="password" placehold="<?php echo app('translator')->getFromJson('admin.password'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.account-manager.password_confirmation'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placehold="<?php echo app('translator')->getFromJson('admin.account-manager.password_confirmation'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="mobile" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.mobile'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="<?php echo e(old('mobile')); ?>" name="mobile" required id="mobile" placehold="<?php echo app('translator')->getFromJson('admin.mobile'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="zipcode" class="bmd-label-floating"></label>
                    <div class="col-xs-10">
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.account-manager.add_account_manager'); ?></button>
                        <a href="<?php echo e(route('admin.account-manager.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>