<?php $__env->startSection('content'); ?>

<?php $login_user = asset('asset/img/login-user-bg.jpg'); ?>
<div class="full-page-bg" style="background-image: url(<?php echo e($login_user); ?>);">
<div class="log-overlay"></div>
    <div class="full-page-bg-inner">
        <div class="row no-margin">
            <div class="col-md-6 log-left">
                <span class="login-logo"><img src="<?php echo e(config('constants.site_logo', asset('logo-black.png'))); ?>"></span>
                <h2>Create your account and move in minutes</h2>
                <p>Welcome to<?php echo e(config('constants.site_title', 'Thinkin Cab')); ?>,The easiest way to get around at the touch of a button.</p>
            </div>
            <div class="col-md-6 log-right">
                <div class="login-box-outer">
                <div class="login-box row no-margin">
                    <div class="col-md-12">
                        <a class="log-blk-btn" href="<?php echo e(url('login')); ?>">ALREADY HAVE AN ACCOUNT?</a>
                        <h3>Change Password</h3>
                    </div>
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <form role="form" method="POST" action="<?php echo e(url('/password/email')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="col-md-12">
                            <input type="email" class="form-control" name="email" placehold="Seu e-mail" value="<?php echo e(old('email')); ?>">

                            <?php if($errors->has('email')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                            <?php endif; ?>                        
                        </div>

                        
                        <div class="col-md-12">
                            <button class="log-teal-btn" type="submit">SEND RESET LINK</button>
                        </div>
                    </form>     

                    <div class="col-md-12">
                        <p class="helper">Ou <a href="<?php echo e(route('login')); ?>">Entre</a> with your user account.                        </p>   
                    </div>

                </div>


                <div class="log-copy"><p class="no-margin"><?php echo e(config('constants.site_copyright', '&copy; '.date('Y').' Thinkin Cab')); ?></p></div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>