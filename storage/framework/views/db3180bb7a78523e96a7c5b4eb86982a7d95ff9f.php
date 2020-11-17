<?php $__env->startSection('title', 'Payment Settings'); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        
        <div class="card card-nav-tabs">
            <div class="card-header card-header-primary">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="paymentMode-tab" data-toggle="tab" href="#paymentMode"
                                    role="tab" aria-controls="paymentMode" aria-expanded="true">Payment Mode</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link " id="paymentSetting-tab" data-toggle="tab" href="#paymentSetting"
                                    role="tab" aria-controls="paymentSetting" aria-expanded="false">Payment Setting</a>
                            </li> -->

                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body ">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane active in" id="paymentMode">
                                <div class="row">
                                    <div class="col">

                                        <form action="<?php echo e(route('admin.settings.payment.store')); ?>" method="POST"
                                            enctype="multipart/form-data">
                                            <?php echo e(csrf_field()); ?>


                                            
                                                <blockquote class="card-blockquote">
                                                    <i class="fa fa-3x fa-money pull-right"></i>
                                                    <div class="form-group">
                                                        <div class="col-xs-4 arabic_right">
                                                            <label for="cash-payments" class="col-form-label">
                                                                <?php echo app('translator')->getFromJson('admin.payment.cash_payments'); ?>
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <input <?php if(config('constants.cash')==1): ?> checked <?php endif; ?>
                                                                autocomplete="off" name="cash" id="cash-payments"
                                                                type="checkbox" class="js-switch" data-color="#43b968">
                                                        </div>
                                                    </div>
                                                </blockquote>
                                            

                                            
                                                <blockquote class="card-blockquote">
                                                    <i class="fa fa-3x fa-cc-stripe pull-right"></i>
                                                    <div class="form-group">
                                                        <div class="col-xs-4 arabic_right">
                                                            <label for="stripe_secret_key" class="col-form-label">
                                                                <?php echo app('translator')->getFromJson('admin.payment.card_payments'); ?>
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <input <?php if(config('constants.card')==1): ?> checked <?php endif; ?>
                                                                autocomplete="off" name="card" id="stripe_check"
                                                                type="checkbox" class="js-switch" data-color="#43b968">
                                                        </div>
                                                    </div>
                                                    <div class="payment_settings" <?php if(config('constants.card')==0): ?>
                                                        style="display: none;" <?php endif; ?>>
                                                        <div class="form-group">
                                                            <label for="stripe_secret_key"
                                                                class="col-xs-4 col-form-label"><?php echo app('translator')->getFromJson('admin.payment.stripe_secret_key'); ?></label>
                                                            <div class="col-xs-8">
                                                                <input class="form-control" type="text"
                                                                    value="<?php echo e(config('constants.stripe_secret_key')); ?>"
                                                                    name="stripe_secret_key" id="stripe_secret_key"
                                                                    placehold="<?php echo app('translator')->getFromJson('admin.payment.stripe_secret_key'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="stripe_publishable_key"
                                                                class="col-xs-4 col-form-label"><?php echo app('translator')->getFromJson('admin.payment.stripe_publishable_key'); ?></label>
                                                            <div class="col-xs-8">
                                                                <input class="form-control" type="text"
                                                                    value="<?php echo e(config('constants.stripe_publishable_key')); ?>"
                                                                    name="stripe_publishable_key"
                                                                    id="stripe_publishable_key"
                                                                    placehold="<?php echo app('translator')->getFromJson('admin.payment.stripe_publishable_key'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="stripe_currency"
                                                                class="col-xs-4 col-form-label"><?php echo app('translator')->getFromJson('admin.payment.currency'); ?></label>
                                                            <div class="col-xs-8">
                                                                <select name="stripe_currency" class="form-control"
                                                                    required>
                                                                    <option
                                                                        <?php if(config('constants.stripe_currency')=="BRL" ): ?>
                                                                        selected <?php endif; ?> value="BRL">BRL</option>
                                                                    <option
                                                                        <?php if(config('constants.stripe_currency')=="INR" ): ?>
                                                                        selected <?php endif; ?> value="BRL">INR</option>
                                                                    <option
                                                                        <?php if(config('constants.stripe_currency')=="USD" ): ?>
                                                                        selected <?php endif; ?> value="USD">USD</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </blockquote>
                                            

                                            <!-- //TODO ALLAN - Alterações débito na máquina e voucher -->
                                            
                                                
                                            

                                            <!-- //TODO ALLAN - Alterações débito na máquina e voucher -->
                                            
                                                
                                            

                                            

                                            <div class="form-group">
                                                <div class="col-xs-4">
                                                    <a href="<?php echo e(URL::previous()); ?>"
                                                        class="btn btn-warning btn-block"><?php echo app('translator')->getFromJson('admin.back'); ?></a>
                                                </div>
                                                <div class="offset-xs-4 col-xs-4">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-block"><?php echo app('translator')->getFromJson('admin.payment.update_site_settings'); ?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="paymentSetting">
                                <div class="row">
                                    <div class="col">
                                        <form action="<?php echo e(route('admin.settings.payment.store')); ?>" method="POST"
                                            enctype="multipart/form-data">
                                            <?php echo e(csrf_field()); ?>

                                            
                                                    <div class="form-group">
                                                        <label for="daily_target"
                                                            class="col-xs-4 col-form-label"><?php echo app('translator')->getFromJson('admin.payment.daily_target'); ?></label>
                                                        <div class="col-xs-8">
                                                            <input class="form-control" type="number"
                                                                value="<?php echo e(config('constants.daily_target', '0')); ?>"
                                                                id="daily_target" name="daily_target" min="0" required
                                                                placehold="Daily Target">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="tax_percentage"
                                                            class="col-xs-4 col-form-label"><?php echo app('translator')->getFromJson('admin.payment.tax_percentage'); ?></label>
                                                        <div class="col-xs-8">
                                                            <input class="form-control" type="number"
                                                                value="<?php echo e(config('constants.tax_percentage', '0')); ?>"
                                                                id="tax_percentage" name="tax_percentage" min="0"
                                                                max="100" placehold="Tax Percentage">
                                                        </div>
                                                    </div>

                                                    

                                                    <div class="form-group">
                                                        <label for="commission_percentage"
                                                            class="col-xs-4 col-form-label"><?php echo app('translator')->getFromJson('admin.payment.commission_percentage'); ?></label>
                                                        <div class="col-xs-8">
                                                            <input class="form-control" type="number"
                                                                value="<?php echo e(config('constants.commission_percentage', '0')); ?>"
                                                                id="commission_percentage" name="commission_percentage"
                                                                min="0" max="100"
                                                                placehold="<?php echo app('translator')->getFromJson('admin.payment.commission_percentage'); ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="peak_percentage"
                                                            class="col-xs-4 col-form-label"><?php echo app('translator')->getFromJson('admin.payment.peak_percentage'); ?></label>
                                                        <div class="col-xs-8">
                                                            <input class="form-control" type="number"
                                                                value="<?php echo e(config('constants.peak_percentage', '0')); ?>"
                                                                id="peak_percentage" name="peak_percentage" min="0"
                                                                max="100"
                                                                placehold="<?php echo app('translator')->getFromJson('admin.payment.peak_percentage'); ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="waiting_percentage"
                                                            class="col-xs-4 col-form-label"><?php echo app('translator')->getFromJson('admin.payment.waiting_percentage'); ?></label>
                                                        <div class="col-xs-8">
                                                            <input class="form-control" type="number"
                                                                value="<?php echo e(config('constants.waiting_percentage', '0')); ?>"
                                                                id="waiting_percentage" name="waiting_percentage"
                                                                min="0" max="100"
                                                                placehold="<?php echo app('translator')->getFromJson('admin.payment.waiting_percentage'); ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="minimum_negative_balance"
                                                            class="col-xs-4 col-form-label"><?php echo app('translator')->getFromJson('admin.payment.minimum_negative_balance'); ?></label>
                                                        <div class="col-xs-8">
                                                            <input class="form-control" type="number"
                                                                value="<?php echo e(config('constants.minimum_negative_balance')); ?>"
                                                                id="minimum_negative_balance"
                                                                name="minimum_negative_balance" max='0'
                                                                placehold="<?php echo app('translator')->getFromJson('admin.payment.minimum_negative_balance'); ?>">
                                                        </div>
                                                    </div>

                                            <div class="form-group">
                                                <div class="col-xs-4">
                                                    <a href="<?php echo e(URL::previous()); ?>"
                                                        class="btn btn-warning btn-block"><?php echo app('translator')->getFromJson('admin.back'); ?></a>
                                                </div>
                                                <div class="offset-xs-4 col-xs-4">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-block"><?php echo app('translator')->getFromJson('admin.payment.update_site_settings'); ?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('scripts'); ?>
        <script type="text/javascript">
            $('.js-switch').on('change', function () {
                if ($(this).is(':checked')) {
                    // console.log($(this).closest('blockquote').find('.payment_settings'));
                    $(this).closest('blockquote').find('.payment_settings').fadeIn(700);
                } else {
                    $(this).closest('blockquote').find('.payment_settings').fadeOut(700);
                }

            });
        </script>
        <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>