<?php $__env->startSection('title', 'Atualizar Documento '); ?>

<?php $__env->startSection('content'); ?>


    <div class="container-fluid">
    	<div class="card">
			<div class="card-header card-header-primary">
			  <h5 class="card-title"><?php echo app('translator')->getFromJson('admin.document.update_document'); ?></h5>
			  <a href="<?php echo e(URL::previous()); ?>" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
			</div>
			<div class="card-body">

            <form class="form-horizontal" action="<?php echo e(route('admin.document.update', $document->id )); ?>" method="POST" enctype="multipart/form-data" role="form">
            	<?php echo e(csrf_field()); ?>

            	<input type="hidden" name="_method" value="PATCH">
				<div class="form-group">
					<label for="name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.document.document_name'); ?></label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="<?php echo e($document->name); ?>" name="name" required id="name" placehold="Nome do <?php echo app('translator')->getFromJson('admin.document.document_name'); ?>">
					</div>
				</div>

                <div class="form-group">
                    <label for="name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.document.document_type'); ?></label>
                    <div class="col-xs-10">
                        <select name="type">
                            <option value="DRIVER" <?php if($document->type == 'DRIVER'): ?> selected <?php endif; ?>><?php echo app('translator')->getFromJson('admin.document.driver_review'); ?></option>
                            <option value="VEHICLE" <?php if($document->type == 'VEHICLE'): ?> selected <?php endif; ?>><?php echo app('translator')->getFromJson('admin.document.vehicle_review'); ?></option>
                        </select>
                    </div>
                </div>

				<div class="form-group">
					<label for="zipcode" class="bmd-label-floating"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.document.update_document'); ?></button>
						<a href="<?php echo e(route('admin.document.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>