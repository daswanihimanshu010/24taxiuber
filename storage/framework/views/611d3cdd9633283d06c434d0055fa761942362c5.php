<?php $__env->startSection('title', 'Provider Documents '); ?>

<?php $__env->startSection('content'); ?>
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title"><?php echo app('translator')->getFromJson('admin.provides.type_allocation'); ?></h4>
                <h5>Driver: <b><?php echo e($Provider->first_name); ?> <?php echo e($Provider->last_name); ?></b> </h5>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-status')): ?>
                <?php if($Provider->status == 'approved'): ?>
                <a style="margin-left: 1em;margin-top: -30px" class="btn btn-danger pull-right"
                    href="<?php echo e(route('admin.provider.disapprove', $Provider->id )); ?>"><i class="fa fa-power-off"></i>
                    Disable Driver</a>
                <?php else: ?>
                <a style="margin-left: 1em;margin-top: -30px" class="btn btn-success pull-right"
                    href="<?php echo e(route('admin.provider.approve', $Provider->id )); ?>"><i class="fa fa-check"></i> Approve
                    Driver</a>
                <?php endif; ?>
                <?php endif; ?>
                <a href="<?php echo e($backurl); ?>" style="margin-left: 1em;margin-top: -30px" class="btn btn-primary pull-right"><i
                        class="fa fa-arrow-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <?php if($ProviderService->count() > 0): ?>
                        <hr><h6>Allocated Services :  </h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->getFromJson('admin.provides.service_name'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('admin.provides.service_number'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('admin.provides.service_model'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $ProviderService; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($service->service_type->name); ?></td>
                                        <td><?php echo e($service->service_number); ?></td>
                                        <td><?php echo e($service->service_model); ?></td>
                                        <td>
                                            <form action="<?php echo e(route('admin.provider.document.service', [$Provider->id, $service->id])); ?>" method="POST">
                                                <?php echo e(csrf_field()); ?>

                                                <?php echo e(method_field('DELETE')); ?>

                                                <button class="btn btn-danger btn-large btn-block">Delete</a>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><?php echo app('translator')->getFromJson('admin.provides.service_name'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('admin.provides.service_number'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('admin.provides.service_model'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <?php endif; ?>
                        <hr>
                    </div>
                </div>

                <div class="row"> 
                    <form action="<?php echo e(route('admin.provider.document.store', $Provider->id)); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <div class="col">
                            <select class="form-control bmd-form-group input" name="service_type" required>
                                <?php $__empty_1 = true; $__currentLoopData = $ServiceTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <option value="<?php echo e($Type->id); ?>"><?php echo e($Type->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <option>- Please Create a Service Type -</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" required name="service_number" class="form-control bmd-form-group" placeholder="Number (CY 98769)">
                        </div>
                        <div class="col">
                            <input type="text" required name="service_model" class="form-control bmd-form-group" placeholder="Model (Audi R8 - Black)">
                        </div>
                        <div class="col">
                            <button class="btn btn-primary btn-block bmd-form-group" type="submit">Update</button>
                        </div>
                    </form>
                </div>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-documents')): ?>
        <div class="card">
            <div class="card-header card-header-primary">
                <h5 class="card-title">
                    <?php echo app('translator')->getFromJson('admin.provides.provider_documents'); ?><br>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-status')): ?>
                    <?php if($Provider->status != 'approved'): ?>
                    <?php if($Provider->documents()->count()): ?>
                    <?php if($Provider->documents->last()->status == "ACTIVE"): ?>
                    <a class="btn btn-success btn-block"
                        href="<?php echo e(route('admin.provider.approve', $Provider->id )); ?>">Approve</a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                </h5>
            </div>
            <?php if( Setting::get('demo_mode', 0) == 0): ?>
            <?php if(count($Provider->documents)>0): ?>
            
            <?php endif; ?>
            <?php endif; ?>
            <div class="card-body">
                <div class="table-responsive">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo app('translator')->getFromJson('admin.provides.document_type'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.status'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $Provider->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Index => $Document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($Index + 1); ?></td>
                            <td><?php echo e($Document->document->name); ?></td>
                            <td><?php echo e($Document->status); ?></td>
                            <td>
                                <div class="input-group-btn">
                                    <a href="<?php echo e(route('admin.provider.document.edit', [$Provider->id, $Document->id])); ?>"><span class="btn btn-success btn-large">View</span></a>
                                    <button class="btn btn-danger btn-large" form="form-delete">Delete</button>
                                    <form action="<?php echo e(route('admin.provider.document.destroy', [$Provider->id, $Document->id])); ?>" method="POST" id="form-delete">
                                        <?php echo e(csrf_field()); ?>

                                        <?php echo e(method_field('DELETE')); ?>

                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th><?php echo app('translator')->getFromJson('admin.provides.document_type'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.status'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>